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
      $products = Product::with('images')->get();
      foreach ($products as $product) {
        $product->images->transform(function ($image) {
          $image->url = asset('storage/' . $image->path);
          return $image;
        });
      }

      return response()->json(['products' => $products]);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при получении товаров'], 500);
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

  public function showByCategory($category_id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    Session::put('previous_url', url()->current());
    $products = Product::where('category_id', $category_id)->get();
    $categories = Category::orderBy('order_index')->get();
    $currentCategory = Category::find($category_id);
    return view('admin.category_page', compact('products', 'categories', 'currentCategory'));
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

  public function getAllProductsCategory($category_id): JsonResponse
  {
    $products = Product::with('images')
      ->where('category_id', $category_id)
      ->get();

    $formattedProducts = $products->map(function ($product) {
      $imagePath = null;
      if ($product->images->isNotEmpty()) {
        $imagePath = $product->images->first()->path;
      }

      return [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'description' => $product->description,
        'article' => $product->article,
        'category_id' => $product->category_id,
        'image_path' => $imagePath,
      ];
    });

    return response()->json(['products' => $formattedProducts]);
  }

  public function searchProductsInCategory(Request $request, $category_id): JsonResponse
  {
    $query = $request->input('query');

    $productsQuery = Product::with('images')
      ->where('category_id', $category_id)
      ->where(function ($queryBuilder) use ($query) {
        $queryBuilder->where('name', 'like', "%$query%")
          ->orWhere('description', 'like', "%$query%");
      });

    $products = $query ? $productsQuery->get() : collect([]);
    $formattedProducts = $products->map(function ($product) {
      $imagePath = null;
      if ($product->images->isNotEmpty()) {
        $imagePath = $product->images->first()->path;
      }

      return [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'description' => $product->description,
        'article' => $product->article,
        'category_id' => $product->category_id,
        'image_path' => $imagePath,
      ];
    });

    return response()->json(['products' => $formattedProducts]);
  }
}