<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  protected function redirectTo($request): void
  {
    if (!$request->expectsJson()) {
      throw new AuthenticationException('Unauthenticated');
    }
  }

  public function handle($request, Closure $next, ...$guards)
  {
    try {
      $this->authenticate($request, $guards);
    } catch (AuthenticationException) {
      throw new AuthenticationException('Unauthenticated');
    }

    return $next($request);
  }
}