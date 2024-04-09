<?php

use App\Http\Controllers\ImprovementController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('checkdb')->group(function () {
  Route::post('/improvements-form', [ImprovementController::class, 'create']);
});