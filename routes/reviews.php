<?php

use App\Http\Controllers\ImprovementController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('checkdb')->group(function () {
  Route::prefix('reviews')->group(function () {
    Route::get('/main', [ReviewController::class, 'homePage'])->name('reviews');
    Route::get('/page', [ReviewController::class, 'reviewsPage'])->name('reviews');
    Route::get('/average-rating', [ReviewController::class, 'getAverageRating']);
  });

  Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reviews-form', [ReviewController::class, 'store'])->name('reviews-form');
  });
});