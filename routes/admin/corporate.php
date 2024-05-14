<?php

use App\Http\Controllers\Admin\CorporateStatementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'auth:sanctum', 'checkdb'])->prefix('api/admin/corporate-statements')->group(function () {
  Route::get('/', [CorporateStatementController::class, 'index']);
  Route::delete('/{id}', [CorporateStatementController::class, 'destroy']);
});