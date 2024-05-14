<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
  public function index(): JsonResponse
  {
    $categories = Category::all();
    return response()->json($categories);
  }

  public function categoriesWithProducts(): JsonResponse
  {
    $categories = Category::with(['products.images', 'products.category'])
      ->withCount('products')
      ->whereHas('products')
      ->get();

    $categories->transform(function ($category) {
      $products = $category->products;
      $category->totalCount = $products->count();
      $selectedProductsCount = min($category->totalCount, 6);
      $selectedProductsCount = max($selectedProductsCount, 2);
      $selectedProducts = $products->slice(0, $selectedProductsCount);

      $category->minPrice = $selectedProducts->min('price');

      $selectedProducts->transform(function ($product) {
        $product->images->transform(function ($image) {
          $image->url = asset('storage/' . $image->path);
          return $image;
        });
        return $product;
      });

      $category->products = $selectedProducts;

      return $category;
    });

    return response()->json($categories);
  }
}