<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/products')->group(function () {
  Route::get('/', [ProductController::class, 'index']);
  Route::post('/create', [ProductController::class, 'store']);
  Route::delete('/{id}', [ProductController::class, 'destroy']);
  Route::get('/category/{category_id}', [ProductController::class, 'productsByCategory']);
  Route::get('/{id}/edit', [ProductController::class, 'edit']);
  Route::post('/{id}/edit', [ProductController::class, 'update']);
});