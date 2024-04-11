<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $products = Product::with('composition', 'images', 'category')->get();
      foreach ($products as $product) {
        foreach ($product->images as $image) {
          $image->url = asset('storage/' . $image->path);
        }
      }

      return response()->json($products);
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при загрузке категорий'], 500);
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
}