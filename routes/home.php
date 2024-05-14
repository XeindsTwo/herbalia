<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('checkdb')->group(function () {
  Route::get('/categories', [HomeController::class, 'index']);
  Route::get('/categories-with-products', [HomeController::class, 'categoriesWithProducts']);
});