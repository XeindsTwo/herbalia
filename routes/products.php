<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('checkdb')->group(function () {
  Route::get('/products/{id}', [ProductController::class, 'show']);
});