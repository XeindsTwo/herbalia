<?php

use App\Http\Controllers\Admin\AdminReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/reviews', [AdminReviewController::class, 'reviewsForApproval'])->name('admin.reviews.index');
    Route::get('/admin/reviews/approved', [AdminReviewController::class, 'approvedReviews'])->name('admin.reviews.approved');
    Route::get('/admin/reviews/home', [AdminReviewController::class, 'approvedReviewsHomepage'])->name('admin.reviews.home');
    Route::put('/admin/reviews/approve/{id}', [AdminReviewController::class, 'approveReview']);
    Route::put('/admin/reviews/update-display-on-homepage', [AdminReviewController::class, 'updateDisplayOnHomepage'])
        ->name('admin.reviews.updateDisplayOnHomepage');
    Route::delete('/admin/reviews/delete/{id}', [AdminReviewController::class, 'deleteReview']);
});