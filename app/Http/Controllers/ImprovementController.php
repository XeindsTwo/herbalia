<?php

namespace App\Http\Controllers;

use App\Models\Improvement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ImprovementController extends Controller
{
  public function create(Request $request)
  {
    $key = 'improvement_requests_' . $request->ip();
    $maxRequests = 3;
    $decayInSeconds = 1800;

    try {
      if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
        RateLimiter::hit($key, $decayInSeconds);
        $validator = Validator::make($request->all(), [
          'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
          'email' => 'nullable|email|max:80',
          'suggestion_comment' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
        }

        Improvement::create([
          'name' => $request->name,
          'email' => $request->email,
          'suggestion_comment' => $request->suggestion_comment,
        ]);

        return response()->json(['message' => 'Предложение успешно отправлено!'], 201);
      } else {
        return response()->json(['error' => 'Превышено максимальное количество ваших предложений. Пожалуйста, попробуйте чуть позже'], 429);
      }
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка. Пожалуйста, попробуйте еще раз'], 500);
    }
  }
}