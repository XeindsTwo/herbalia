<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('checkdb')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [RegisterController::class, 'register']);

  Route::post('/check-email', function (Request $request) {
    $email = $request->input('email');
    $user = User::where('email', $email)->first();
    return response()->json([
      'exists' => !!$user,
    ]);
  });

  Route::post('/check-login', function (Request $request) {
    $login = $request->input('login');
    $user = User::where('login', $login)->first();
    return response()->json([
      'exists' => !!$user,
    ]);
  });
});

Route::prefix('api')->middleware(['auth:sanctum', 'checkdb'])->group(function () {
  Route::get('/user-role', [AuthController::class, 'getUserRole']);
  Route::get('/user-info', [AuthController::class, 'getUserInfo']);
  Route::post('/logout', [AuthController::class, 'logout']);
});