<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
  public function store(Request $request): JsonResponse
  {
    try {
      $productIds = $request->input('productIds');
      $favoriteProducts = Product::with('composition', 'images', 'category')
        ->whereIn('id', $productIds)
        ->get();

      $favoriteProducts->transform(function ($product) {
        $firstImage = $product->images->first();
        if ($firstImage) {
          $firstImage->url = asset('storage/' . $firstImage->path);
        }
        return $product;
      });

      return response()->json(['message' => 'Избранные товары успешно сохранены', 'favorites' => $favoriteProducts]);
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при сохранении избранных товаров'], 500);
    }
  }
}