<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      if (!Auth::check()) {
        return response()->json(['error' => 'Вы должны быть авторизованы для просмотра корзины'], 401);
      }

      $userId = Auth::id();
      $cartItems = Cart::with('product.images')->where('user_id', $userId)->get();

      $cartItems->each(function ($cartItem) {
        $product = $cartItem->product;
        $cartItem->image_url = $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : null;
      });

      return response()->json($cartItems);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при получении корзины: ' . $e->getMessage()], 500);
    }
  }

  public function addToCart(Request $request): JsonResponse
  {
    try {
      if (!Auth::check()) {
        return response()->json(['error' => 'Вы должны быть авторизованы для добавления товара в корзину'], 401);
      }

      $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1|max:1000',
      ]);

      $userId = Auth::id();
      $productId = $request->product_id;
      $quantity = $request->quantity;

      Product::findOrFail($productId);
      $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

      if ($cartItem) {
        $newQuantity = $cartItem->quantity + $quantity;
        if ($newQuantity > 50) {
          return response()->json(['error' => 'Превышен лимит на данный товар в корзине. Максимальное количество - 50 единиц'], 402);
        }
        $cartItem->quantity = $newQuantity;
        $cartItem->save();
      } else {
        Cart::create([
          'user_id' => $userId,
          'product_id' => $productId,
          'quantity' => $quantity,
        ]);
      }

      return response()->json(['message' => 'Товар успешно добавлен в корзину']);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->validator->errors()->first()], 422);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при добавлении товара в корзину: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Request $request): JsonResponse
  {
    try {
      $userId = Auth::id();
      $productId = $request->input('product_id');

      Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->delete();

      return response()->json(['message' => 'Товар успешно удален из корзины']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при удалении товара из корзины: ' . $e->getMessage()], 500);
    }
  }

  public function update(Request $request): JsonResponse
  {
    try {
      $request->validate([
        'product_id' => 'required|exists:carts,product_id,user_id,' . Auth::id(),
        'quantity' => 'required|integer|min:1|max:50',
      ]);

      $userId = Auth::id();
      $productId = $request->input('product_id');
      $newQuantity = $request->input('quantity');

      $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

      if (!$cartItem) {
        return response()->json(['error' => 'Товар не найден в корзине'], 404);
      }

      $cartItem->update(['quantity' => $newQuantity]);

      return response()->json(['message' => 'Количество товара в корзине успешно обновлено']);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->validator->errors()->first()], 422);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при обновлении количества товара в корзине: ' . $e->getMessage()], 500);
    }
  }
}