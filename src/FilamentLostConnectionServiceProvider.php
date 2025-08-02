<?php

namespace Amarafiif\FilamentLostConnection;

use Illuminate\Support\ServiceProvider;

class FilamentLostConnectionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-lost-connection');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-lost-connection'),
        ], 'filament-lost-connection-views');
        
        $this->publishes([
            __DIR__.'/../config/filament-lost-connection.php' => config_path('filament-lost-connection.php'),
        ], 'filament-lost-connection-config');
    }

    public function register(): void
    {
        $this->app->singleton('filament-lost-connection.config', function ($app) {
            return $app['config']['filament-lost-connection'] ?? [];
        });
    }
}
