<?php

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
})->name('how_order');