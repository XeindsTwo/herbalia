<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::post('/api/favorites', [FavoriteController::class, 'store']);