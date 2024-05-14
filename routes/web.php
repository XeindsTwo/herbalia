<?php

use App\Http\Controllers\CorporateStatementController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::post('/api/favorites', [FavoriteController::class, 'store']);
Route::post('/api/corporate', [CorporateStatementController::class, 'store']);