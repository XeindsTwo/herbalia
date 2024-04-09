<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    if (!$request->user() || $request->user()->role !== 'ADMIN') {
      return response()->json(['error' => 'Доступ запрещен к данному ресурсу'], 403);
    }

    return $next($request);
  }
}