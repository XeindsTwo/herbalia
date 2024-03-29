<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/create', [ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/products/category/{category_id}', [ProductController::class, 'showByCategory'])->name('admin.products.category');
    Route::get('/admin/products/category/{category_id}/all', [ProductController::class, 'getAllProductsCategory']);
    Route::get('/admin/products/category/{category_id}/search', [ProductController::class, 'searchProductsInCategory'])->name('admin.products.category.search');
});