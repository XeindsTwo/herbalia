<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/order')->middleware(['auth:sanctum', 'checkdb'])->group(function () {
  Route::get('/', [OrderController::class, 'index']);
  Route::post('/', [OrderController::class, 'store']);
});