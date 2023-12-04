<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/catalog/{id}', [ProductController::class, 'show'])->name('product.show');
});