<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $products = Product::with('composition', 'images', 'category')->get();

      $productData = $products->map(function ($product) {
        return [
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'category_id' => $product->category->id,
          'composition' => $product->composition,
          'image_url' => $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : null,
        ];
      });

      $minPrice = $products->min('price');
      $totalCount = $products->count();

      return response()->json([
        'min_price' => $minPrice,
        'total_count' => $totalCount,
        'products' => $productData,
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при загрузке товаров'], 500);
    }
  }

  public function getByCategory(int $categoryId): JsonResponse
  {
    try {
      $category = Category::findOrFail($categoryId);
      $products = $category->products()->with('composition')->get();
      $products->each(function ($product) {
        $product->image_url = asset('storage/' . $product->images()->first()->path);
      });

      $minPrice = $products->min('price');
      $totalCount = $products->count();

      return response()->json([
        'category_name' => $category->name,
        'min_price' => $minPrice,
        'total_count' => $totalCount,
        'products' => $products,
      ]);
    } catch (Exception) {
      return response()->json(['error' => 'Категория не была найдена'], 404);
    }
  }

  public function getProductByCategory(int $categoryId, int $productId): JsonResponse
  {
    try {
      $category = Category::findOrFail($categoryId);
      $product = $category->products()
        ->with('composition', 'images', 'category')
        ->findOrFail($productId);

      foreach ($product->images as $image) {
        $image->url = asset('storage/' . $image->path);
      }

      return response()->json($product);
    } catch (Exception) {
      return response()->json(['error' => 'Error fetching product'], 500);
    }
  }

  public function search(Request $request): JsonResponse
  {
    try {
      $query = $request->input('query');
      if (!$query) {
        return response()->json(['error' => 'Запрос не указан'], 400);
      }

      $products = Product::with('composition', 'images', 'category')
        ->where(function ($q) use ($query) {
          $q->where('name', 'like', '%' . $query . '%')
            ->orWhereHas('category', function ($q) use ($query) {
              $q->where('name', 'like', '%' . $query . '%');
            });
        })
        ->orderBy('created_at')
        ->get();

      $productData = $products->map(function ($product) {
        return [
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'category_id' => $product->category->id,
          'category' => $product->category->name,
          'composition' => $product->composition,
          'image_url' => $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : null,
        ];
      });

      return response()->json(['products' => $productData])
        ->header('Access-Control-Allow-Origin', 'http://localhost:5173');
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500)
        ->header('Access-Control-Allow-Origin', 'http://localhost:5173');
    }
  }
}