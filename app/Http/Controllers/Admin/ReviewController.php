<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  public function unapprovedReviews(): JsonResponse
  {
    $unapprovedReviews = Review::where('status', false)->get();
    return response()->json($unapprovedReviews);
  }

  public function approvedReviews(): JsonResponse
  {
    $approvedReviews = Review::where('status', true)->get();
    return response()->json($approvedReviews);
  }

  public function updateDisplayOnHomepage(Request $request): JsonResponse
  {
    try {
      $checkedReviews = $request->input('checkedReviews');
      Review::whereIn('id', $checkedReviews)->where('status', true)->update(['display_on_homepage' => true]);
      Review::whereNotIn('id', $checkedReviews)->orWhere('status', false)->update(['display_on_homepage' => false]);
      return response()->json(['message' => 'Статусы отзывов для главной страницы обновлены']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при обновлении статусов отзывов для главной страницы', 'details' => $e->getMessage()], 500);
    }
  }

  public function approveReview($id): JsonResponse
  {
    try {
      $review = Review::find($id);
      if (!$review) {
        return response()->json(['message' => 'Отзыв не найден'], 404);
      }

      if ($review->status) {
        return response()->json(['message' => 'Отзыв уже одобрен'], 400);
      }

      $review->status = true;
      $review->save();
      return response()->json(['message' => 'Отзыв одобрен']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при одобрении отзыва', 'details' => $e->getMessage()], 500);
    }
  }

  public function deleteReview($id): JsonResponse
  {
    try {
      $review = Review::find($id);
      if (!$review) {
        return response()->json(['message' => 'Отзыв не найден'], 404);
      }

      $review->delete();
      return response()->json(['message' => 'Отзыв удален']);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при удалении отзыва', 'details' => $e->getMessage()], 500);
    }
  }
}