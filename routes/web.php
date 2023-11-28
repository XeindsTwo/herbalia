<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('index');
})->name('index');

Route::get('/control', static function () {
    return view('quality_control');
})->name('control');

Route::get('/about', static function () {
    return view('about');
})->name('about');

Route::get('/contacts', static function () {
    return view('contacts');
})->name('contacts');

Route::get('/payment', static function () {
    return view('payment');
})->name('payment');

Route::get('/delivery', static function () {
    return view('delivery');
})->name('delivery');

Route::get('/guarantee', static function () {
    return view('guarantee');
})->name('guarantee');

Route::get('/how_order', static function () {
    return view('how_order');
})->name('howOrder');

Route::get('/faq', static function () {
    return view('faq');
})->name('faq');

Route::get('/corporate', static function () {
    return view('corporate');
})->name('corporate');

Route::get('/agreement', static function () {
    return view('agreement');
})->name('agreement');

Route::get('/flower-care', static function () {
    return view('flower_care');
})->name('flower-care');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/check-email', function (Request $request) {
    $email = $request->input('email');
    $user = User::where('email', $email)->first();
    return response()->json([
        'exists' => !!$user,
    ]);
});