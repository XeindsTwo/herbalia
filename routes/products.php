<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/products')->middleware('checkdb')->group(function () {
  Route::get('/{id}', [ProductController::class, 'show']);
});