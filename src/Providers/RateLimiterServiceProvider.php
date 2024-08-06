<?php

namespace Rapidsquirrel\LaravelRateLimiter\Providers;

use Illuminate\Support\ServiceProvider;
use Rapidsquirrel\LaravelRateLimiter\Http\Middleware\RateLimiter;

class RateLimiterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the config file
        $this->publishes([
            __DIR__.'/../../config/ratelimiter.php' => config_path('ratelimiter.php'),
        ]);

        // Register middleware
        $this->app['router']->aliasMiddleware('rate.limiter', RateLimiter::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/ratelimiter.php', 'ratelimiter'
        );

        $this->app->singleton(RateLimiter::class, function ($app) {
            return new RateLimiter(
                config('ratelimiter.max_attempts'),
                config('ratelimiter.decay_minutes')
            );
        });
    }
}
