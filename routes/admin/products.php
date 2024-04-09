<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/products')->group(function () {
  Route::get('/', [ProductController::class, 'index']);
  Route::post('/create', [ProductController::class, 'store']);
  Route::delete('/{id}', [ProductController::class, 'destroy']);
  Route::get('/category/{category_id}', [ProductController::class, 'showByCategory'])->name('admin.products.category');
  Route::get('/category/{category_id}/all', [ProductController::class, 'getAllProductsCategory']);
  Route::get('/category/{category_id}/search', [ProductController::class, 'searchProductsInCategory'])->name('admin.products.category.search');
});