<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
  public const HOME = '/home';

  public function boot(): void
  {
    RateLimiter::for('api', function (Request $request) {
      return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });

    $this->routes(function () {
      Route::middleware('api')
        ->prefix('api')
        ->group(base_path('routes/api.php'));
      Route::middleware('web')
        ->group(base_path('routes/web.php'));
      Route::middleware('web')
        ->group(base_path('routes/home.php'));
      Route::middleware('web')
        ->group(base_path('routes/auth.php'));
      Route::middleware('web')
        ->group(base_path('routes/profile.php'));
      Route::middleware('web')
        ->group(base_path('routes/cart.php'));
      Route::middleware('web')
        ->group(base_path('routes/order.php'));
      Route::middleware('web')
        ->group(base_path('routes/admin/routes.php'));
      Route::middleware('web')
        ->group(base_path('routes/reviews.php'));
      Route::middleware('web')
        ->group(base_path('routes/improvements.php'));
      Route::middleware('web')
        ->group(base_path('routes/products.php'));
      Route::middleware('web')
        ->group(base_path('routes/catalog.php'));
    });
  }
}