<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

public function map()
{
    $this->mapApiRoutes();
    $this->mapWebRoutes();
}

protected function mapApiRoutes()
{
    Route::prefix('api') // Optional: Routes will have /api prefix
         ->middleware('api') // Optional: Adds the api middleware group
         ->namespace($this->namespace)
         ->group(base_path('routes/api.php')); // Ensure this points to your api.php file
}

protected function mapWebRoutes()
{
    Route::middleware('web')
         ->namespace($this->namespace)
         ->group(base_path('routes/web.php'));
}

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Example of rate limiting for admin update routes
        RateLimiter::for('admin-update', function ($request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(10); // Limit to 5 requests per minute
        });
    }
}
