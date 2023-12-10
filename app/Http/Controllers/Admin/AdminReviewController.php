<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminReviewController extends Controller
{
    public function reviewsForApproval(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reviewsForApproval = Review::where('status', false)->get();
        return view('admin.reviews.reviews_for_approval', ['reviewsForApproval' => $reviewsForApproval]);
    }

    public function approvedReviews(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $approvedReviews = Review::where('status', true)->get();

        return view('admin.reviews.approved_reviews', ['approvedReviews' => $approvedReviews]);
    }

    public function approvedReviewsHomepage(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $approvedReviews = Review::where('status', true)->get();

        return view('admin.reviews.approved_reviews_homepage', ['approvedReviews' => $approvedReviews]);
    }

    public function updateDisplayOnHomepage(Request $request): JsonResponse
    {
        $checkedReviews = $request->input('checkedReviews');
        Review::whereIn('id', $checkedReviews)->update(['display_on_homepage' => true]);
        $uncheckedReviews = Review::whereNotIn('id', $checkedReviews)->pluck('id');
        Review::whereIn('id', $uncheckedReviews)->update(['display_on_homepage' => false]);
        return response()->json(['message' => 'Статусы отзывов для главной страницы обновлены']);
    }

    public function approveReview(Request $request, $id): JsonResponse
    {
        $review = Review::find($id);
        if (!$review) {
            return Response::json(['message' => 'Отзыв не найден'], 404);
        }

        $review->status = true;
        $review->save();

        return Response::json(['message' => 'Отзыв одобрен']);
    }

    public function deleteReview(Request $request, $id): JsonResponse
    {
        $review = Review::find($id);
        if (!$review) {
            return Response::json(['message' => 'Отзыв не найден'], 404);
        }

        $review->delete();
        return Response::json(['message' => 'Отзыв удален']);
    }
}