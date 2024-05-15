<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/orders')->group(function () {
  Route::get('/', [OrderController::class, 'index']);
  Route::delete('/{id}', [OrderController::class, 'destroy']);
});