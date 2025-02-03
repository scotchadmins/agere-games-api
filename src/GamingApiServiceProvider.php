<?php

namespace Agere\GamingApi;

use Illuminate\Support\ServiceProvider;

class GamingApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/gamingapi.php' => config_path('gamingapi.php'),
        ], 'gamingapi-config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Merge default configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/gamingapi.php',
            'gamingapi'
        );

        // Bind the API class
        $this->app->singleton(AgereGamingApi::class, function ($app) {
            return new AgereGamingApi(config('gamingapi'));
        });

        // Alias for easy access
        $this->app->alias(AgereGamingApi::class, 'gamingapi');
    }
}
