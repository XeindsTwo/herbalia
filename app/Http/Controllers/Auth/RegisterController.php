<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|max:60|regex:/^[^\sа-яА-Я]*$/',
      ]);

      User::create([
        'login' => $validatedData['login'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'USER',
      ]);

      return response()->json(['message' => 'Успешная регистрация!'], 201);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->getMessage()], 422);
    } catch (Exception) {
      return response()->json(['message' => 'Ошибка при регистрации'], 500);
    }
  }
}