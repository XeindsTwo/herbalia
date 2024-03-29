<?php

use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

include 'errors.php';

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

Route::get('/generate-captcha', [CaptchaController::class, 'generateCaptcha'])->name('generate-captcha');
Route::post('/validate-captcha', [CaptchaController::class, 'validateCaptcha']);