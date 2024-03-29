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
                ->group(base_path('routes/auth/auth.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin/category.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin/products.php'));
            Route::middleware('web')
                ->group(base_path('routes/reviews.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin/reviews.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin/users.php'));
        });
    }
}