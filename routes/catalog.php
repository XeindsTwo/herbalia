<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/catalog')->middleware('checkdb')->group(function () {
  Route::get('/', [CatalogController::class, 'index']);
  Route::get('/{categoryId}', [CatalogController::class, 'getByCategory']);
  Route::get('/{categoryId}/{productId}', [CatalogController::class, 'getProductByCategory']);
  Route::post('/search', [CatalogController::class, 'search']);
});