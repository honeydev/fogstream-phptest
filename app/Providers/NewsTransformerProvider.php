<?php

namespace News\Providers;

use Illuminate\Support\ServiceProvider;

class NewsTransformerProvider extends ServiceProvider
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
        $this->app->bind(\News\Transformers\NewsTransformer::class, function ($app) {

            return new \News\Transformers\NewsTransformer();
        });
    }
}
