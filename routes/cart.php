<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/cart')->middleware(['auth:sanctum', 'checkdb'])->group(function () {
  Route::get('/', [CartController::class, 'index']);
  Route::post('/add', [CartController::class, 'addToCart']);
  Route::delete('/remove', [CartController::class, 'destroy']);
  Route::post('/update/{cart_id}', [CartController::class, 'update']);
});