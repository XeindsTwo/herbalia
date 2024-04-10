<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
  public function show(string $id): JsonResponse
  {
    try {
      $product = Product::with('composition', 'images', 'category')->findOrFail($id);
      foreach ($product->images as $image) {
        $image->url = asset('storage/' . $image->path);
      }

      return response()->json(['product' => $product]);
    } catch (Exception) {
      return response()->json(['error' => 'Товар не найден'], 404);
    }
  }
}