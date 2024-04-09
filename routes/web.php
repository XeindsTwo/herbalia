<?php

use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

Route::get('/generate-captcha', [CaptchaController::class, 'generateCaptcha'])->name('generate-captcha');
Route::post('/validate-captcha', [CaptchaController::class, 'validateCaptcha']);