<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\CorporateStatement;
use Illuminate\Validation\ValidationException;
use Exception;

class CorporateStatementController extends Controller
{
  public function store(Request $request)
  {
    $key = 'corporate_statements_' . $request->ip();
    $maxRequests = 3;
    $decayInSeconds = 1800;

    try {
      if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
        RateLimiter::hit($key, $decayInSeconds);

        $validatedData = $request->validate([
          'name' => 'required|string|min:2|max:50',
          'phone' => 'required|string|max:20',
          'email' => 'required|email|max:80',
          'company' => 'required|string|max:255',
        ]);

        $corporateStatement = new CorporateStatement($validatedData);
        $corporateStatement->save();

        return response()->json(['message' => 'Заявка успешно добавлена']);
      } else {
        return response()->json(['error' => 'Превышено максимальное количество ваших запросов. Пожалуйста, попробуйте чуть позже'], 429);
      }
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->getMessage()], 422);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка. Пожалуйста, попробуйте еще раз'], 500);
    }
  }
}