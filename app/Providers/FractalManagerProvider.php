<?php

namespace News\Providers;

use Illuminate\Support\ServiceProvider;

class FractalManagerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\League\Fractal\Manager::class, function ($app) {
            return new \League\Fractal\Manager();
        });
    }
}
