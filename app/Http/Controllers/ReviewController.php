<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
  public function homePage(): JsonResponse
  {
    $reviews = Review::where('status', true)
      ->where('display_on_homepage', true)
      ->get();

    return response()->json([
      'reviews' => $reviews
    ]);
  }

  public function reviewsPage(): JsonResponse
  {
    $reviews = Review::where('status', true)->get();

    return response()->json([
      'reviews' => $reviews,
    ]);
  }

  public function getAverageRating(): JsonResponse
  {
    $averageRating = Review::where('status', true)->avg('rating') ?? 0;
    $formattedAverageRating = number_format($averageRating, 1);
    return response()->json(['averageRating' => $formattedAverageRating]);
  }

  public function store(Request $request)
  {
    $key = 'reviews_' . $request->ip();
    $maxRequests = 3;
    $decayInSeconds = 1800;

    try {
      if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
        RateLimiter::hit($key, $decayInSeconds);

        if (Auth::check()) {
          $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
            'email' => 'required|email|max:80',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
          ]);

          $review = new Review($validatedData);
          Auth::user()->reviews()->save($review);

          return response()->json(['message' => 'Отзыв был успешно добавлен']);
        } else {
          return response()->json(['message' => 'Пользователь не авторизован'], 403);
        }
      } else {
        return response()->json(['error' => 'Превышено максимальное количество ваших отзывов. Пожалуйста, попробуйте чуть позже'], 429);
      }
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->getMessage()], 422);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка. Пожалуйста, попробуйте еще раз'], 500);
    }
  }
}