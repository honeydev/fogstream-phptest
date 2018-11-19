<?php

namespace News\Providers;

use Illuminate\Support\ServiceProvider;

class AvatarSaverProvider extends ServiceProvider
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
        $this->app->bind('News\Savers\AvatarSaver', function ($app) {
            return new News\Savers\AvatarSaver();
        });
    }
}
