<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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

  public function store(Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'phone_number' => 'required|string|max:20',
      'email' => 'required|email|max:255',
      'delivery_address' => 'nullable|string|max:255',
      'comment' => 'nullable|string|max:2500',
      'delivery_option' => 'required|in:pickup,delivery',
      'payment_option' => 'required|in:cash,non-cash',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 422);
    }

    $userId = Auth::id();

    DB::beginTransaction();

    try {
      $cartItems = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('products.name', 'products.id as product_id', 'products.price', 'carts.quantity')
        ->where('carts.user_id', $userId)
        ->get();

      $order = new Order();
      $order->user_id = $userId;
      $order->fill($validator->validated());
      $order->save();

      $totalPrice = 0;

      foreach ($cartItems as $item) {
        $subtotal = $item->price * $item->quantity;
        $totalPrice += $subtotal;

        $order->products()->attach($item->product_id, ['quantity' => $item->quantity, 'total_price' => $subtotal]);
      }

      $order->total_price = $totalPrice;
      $order->save();

      DB::table('carts')->where('user_id', $userId)->delete();

      DB::commit();

      return response()->json(['success' => 'Заказ был успешно создан']);
    } catch (Exception $e) {
      DB::rollBack();
      \Log::error('Ошибка при создании заказа: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
      return response()->json(['error' => 'Ошибки при создании заказа: ' . $e->getMessage()], 500);
    }
  }
}