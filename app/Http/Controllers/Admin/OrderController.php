<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $orders = Order::with('products.images')->get();
      $orders->each(function ($order) {
        $order->products->each(function ($product) {
          $product->image_url = $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : null;
        });
      });

      return response()->json($orders);
    } catch (Exception $e) {
      return response()->json(['error' => 'Произошла ошибка при получении данных: ' . $e->getMessage()], 500);
    }
  }

  public function destroy($id): JsonResponse
  {
    try {
      $order = Order::findOrFail($id);
      $order->products()->detach();
      $order->delete();

      return response()->json(['success' => 'Заказ успешно удален']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при удалении заказа: ' . $e->getMessage()], 500);
    }
  }
}