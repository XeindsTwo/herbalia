<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/reviews-form', [ReviewController::class, 'create'])->middleware('auth')->name('reviews-form');
Route::post('/reviews-form', [ReviewController::class, 'store'])->name('reviews-form');