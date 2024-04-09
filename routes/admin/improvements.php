<?php

use App\Http\Controllers\Admin\ImprovementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/improvements')->group(function () {
  Route::get('/', [ImprovementController::class, 'index']);
  Route::delete('/{id}', [ImprovementController::class, 'delete']);
});