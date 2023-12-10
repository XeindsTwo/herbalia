<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ReviewController extends Controller
{
    public function index(): View|Application|Factory
    {
        $reviews = Review::where('status', true)->get();

        $totalRating = 0;
        $reviewCount = count($reviews);

        foreach ($reviews as $review) {
            $totalRating += $review->rating;
        }

        $averageRating = $reviewCount > 0 ? round($totalRating / $reviewCount, 1) : 0;

        return view('reviews', compact('reviews', 'averageRating'));
    }

    public function create(): Application|Factory|View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('auth');
        }
        return view('reviews-form');
    }

    public function store(Request $request): JsonResponse
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:80',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|max:2000',
            ]);

            $review = new Review($validatedData);
            Auth::user()->reviews()->save($review);

            return response()->json(['message' => 'Отзыв был успешно добавлен'], 200);
        } else {
            return response()->json(['message' => 'Пользователь не авторизован'], 403);
        }
    }
}