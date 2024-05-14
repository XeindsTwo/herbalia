<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductComposition;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $categories = Category::all();
      return response()->json(['categories' => $categories]);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при получении категорий товаров'], 500);
    }
  }

  public function productsByCategory($category_id): JsonResponse
  {
    try {
      $category = Category::find($category_id);

      if (!$category) {
        return response()->json(['error' => 'Категория не найдена'], 404);
      }

      $products = Product::where('category_id', $category_id)->with('images')->get();
      $products->transform(function ($product) {
        $product->images->transform(function ($image) {
          $image->url = asset('storage/' . $image->path);
          return $image;
        });
        return $product;
      });

      return response()->json([
        'category' => $category->name,
        'products' => $products
      ]);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при получении товаров по категории'], 500);
    }
  }

  public function store(Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:240',
      'price' => 'required|numeric|min:1200|max:1000000',
      'photos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
      'category_id' => 'required|exists:categories,id',
      'composition' => 'required|array|min:1',
      'composition.*.name' => 'required|max:240',
      'composition.*.quantity' => 'required|numeric|min:1',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->first()], 400);
    }

    try {
      DB::beginTransaction();
      $product = Product::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'article' => mt_rand(101000, 189999),
        'category_id' => $request->input('category_id'),
      ]);

      $photos = $request->file('photos');
      foreach ($photos as $photo) {
        $this->saveImage($photo, $product);
      }

      $composition = $request->input('composition');
      $this->saveComposition($composition, $product);
      DB::commit();
      return response()->json(['message' => 'Продукт успешно создан']);
    } catch (Exception $e) {
      DB::rollBack();
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  private function saveImage($photo, $product)
  {
    if ($photo->isValid()) {
      $imageName = time() . '_' . $photo->getClientOriginalName();
      $photo->storeAs('public/photos', $imageName);
      $product->images()->create([
        'name' => $imageName,
        'path' => 'photos/' . $imageName,
      ]);
    } else {
      throw new Exception('Некорректный файл изображения');
    }
  }

  private function saveComposition($compositionData, $product)
  {
    try {
      $dataToInsert = [];
      foreach ($compositionData as $data) {
        $dataToInsert[] = [
          'name' => $data['name'],
          'quantity' => $data['quantity'],
          'product_id' => $product->id,
        ];
      }

      ProductComposition::insert($dataToInsert);
    } catch (Exception) {
      throw new Exception('Ошибка сохранения состава товара');
    }
  }

  public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    $product = Product::findOrFail($id);
    $currentCategory = $product->category;
    $currentComposition = $product->composition;
    return view('product_detail', compact('product', 'currentCategory', 'currentComposition'));
  }

  public function destroy(string $id): JsonResponse
  {
    $product = Product::findOrFail($id);
    if ($product) {
      foreach ($product->images as $image) {
        Storage::delete('public/photos/' . $image->name);
      }
      $product->delete();
      return response()->json(['message' => 'Продукт был успешно удален']);
    } else {
      return response()->json(['message' => 'Продукт не был найден'], 404);
    }
  }

  public function edit(string $id): JsonResponse
  {
    try {
      $product = Product::findOrFail($id);
      $categories = Category::all();
      $images = $product->images->map(function ($image) {
        $image->url = asset('storage/' . $image->path);
        return $image;
      });
      $composition = $product->composition;

      return response()->json([
        'product' => $product,
        'categories' => $categories,
        'images' => $images,
        'composition' => $composition,
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function update(Request $request, string $id): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:240',
      'price' => 'required|numeric|min:1200|max:1000000',
      'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
      'category_id' => 'required|exists:categories,id',
      'composition' => 'array|min:1',
      'composition.*.name' => 'required|max:240',
      'composition.*.quantity' => 'required|numeric|min:1',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->first()], 400);
    }

    try {
      DB::beginTransaction();
      $product = Product::findOrFail($id);
      $product->update([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'category_id' => $request->input('category_id'),
      ]);

      $photos = $request->file('photos');
      if ($photos) {
        foreach ($photos as $photo) {
          $this->saveImage($photo, $product);
        }
      }

      $composition = $request->input('composition');
      if ($composition) {
        $this->updateComposition($composition, $product);
      }

      DB::commit();
      return response()->json(['message' => 'Продукт успешно обновлен']);
    } catch (Exception $e) {
      DB::rollBack();
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  public function updateComposition($compositionData, $product)
  {
    try {
      $existingIds = [];
      foreach ($compositionData as $data) {
        if (isset($data['id'])) {
          ProductComposition::where('id', $data['id'])->update([
            'name' => $data['name'],
            'quantity' => $data['quantity'],
          ]);
          $existingIds[] = $data['id'];
        } else {
          $newComposition = ProductComposition::create([
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'product_id' => $product->id,
          ]);
          $existingIds[] = $newComposition->id;
        }
      }

      $product->composition()->whereNotIn('id', $existingIds)->delete();
    } catch (Exception $e) {
      throw new Exception("Ошибка обновления состава товара: " . $e->getMessage());
    }
  }
}