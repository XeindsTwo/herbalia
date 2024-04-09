<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProfileController extends Controller
{
  public function logout(Request $request)
  {
    $tokenId = $request->user()->currentAccessToken()->id;
    $request->user()->tokens()->where('id', $tokenId)->delete();
    return response()->json(['message' => 'Токен успешно удален!']);
  }

  public function getUserInfo()
  {
    if (Auth::check()) {
      $user = Auth::user();
      return response()->json([
        'login' => $user->login,
        'email' => $user->email,
        'name' => $user->name,
      ]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }

  public function updateName(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
    ]);

    $user = Auth::user();
    try {
      $user->name = $request->name;
      $user->save();
    } catch (QueryException) {
      return response()->json(['error' => 'Ошибка сохранения данных'], 500);
    }

    return response()->json(['message' => 'Имя успешно обновлено!', 'name' => $user->name]);
  }

  public function updateEmail(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
    ]);

    $user = Auth::user();
    $newEmail = $request->email;
    $existingUser = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();
    if ($existingUser) {
      return response()->json(['error' => 'Почта занята другим пользователем'], 400);
    }

    try {
      $user->email = $newEmail;
      $user->save();
    } catch (QueryException) {
      return response()->json(['error' => 'Ошибка сохранения данных'], 500);
    }

    return response()->json(['message' => 'Email успешно обновлен!', 'email' => $user->email]);
  }

  public function getReviews()
  {
    $user = Auth::user();
    $reviews = $user->reviews()->orderBy('created_at', 'desc')->get();
    return response()->json($reviews);
  }

  public function deleteReview($id)
  {
    try {
      $user = Auth::user();
      $review = $user->reviews()->findOrFail($id);

      $review->delete();

      return response()->json(['message' => 'Отзыв успешно удален']);
    } catch (Throwable $e) {
      return response()->json(['message' => 'Не удалось удалить отзыв', 'error' => $e->getMessage()], 500);
    }
  }
}