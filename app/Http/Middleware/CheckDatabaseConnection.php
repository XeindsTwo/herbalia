<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckDatabaseConnection
{
  public function handle(Request $request, Closure $next)
  {
    try {
      DB::connection()->getPdo();
    } catch (Exception) {
      return response()->json(['error' => 'Database connection error'], 500);
    }

    return $next($request);
  }
}