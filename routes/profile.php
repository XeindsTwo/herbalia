<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/profile')->middleware(['auth:sanctum', 'checkdb'])->group(function () {
  Route::get('/user-info', [ProfileController::class, 'getUserInfo']);
  Route::post('/logout', [ProfileController::class, 'logout']);
  Route::put('/update-name', [ProfileController::class, 'updateName']);
  Route::put('/update-email', [ProfileController::class, 'updateEmail']);
  Route::get('/reviews', [ProfileController::class, 'getReviews']);
  Route::delete('/reviews/delete/{id}', [ProfileController::class, 'deleteReview']);
});