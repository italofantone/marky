<?php

namespace Italofantone\Marky;

use Illuminate\Support\ServiceProvider;
use Italofantone\Marky\Services\MarkyService;

class MarkyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/marky.php' => config_path('marky.php'),
        ], 'marky-config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('marky', function ($app) {
            return new MarkyService();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/marky.php',
            'marky'
        );        
    }
}