<?php

use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/reviews')->group(function () {
  Route::get('/', [ReviewController::class, 'unapprovedReviews']);
  Route::put('/approve/{id}', [ReviewController::class, 'approveReview']);
  Route::get('/approved', [ReviewController::class, 'approvedReviews']);
  Route::put('/update-display-on-homepage', [ReviewController::class, 'updateDisplayOnHomepage']);
  Route::delete('/delete/{id}', [ReviewController::class, 'deleteReview']);
});