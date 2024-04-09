<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('login', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      $token = $user->createToken('Herbalia', ['role' => $user->role])->plainTextToken;

      return response()->json([
        'message' => 'Вы успешно авторизовались!',
        'token' => $token,
      ]);
    } else {
      return response()->json(['message' => 'Неверно введён логин или пароль'], 401);
    }
  }

  public function getUserRole()
  {
    if (Auth::check()) {
      $user = Auth::user();
      return response()->json(['role' => $user->role]);
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }
}