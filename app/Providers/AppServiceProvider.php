<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        resolve(EngineManager::class)->extend('explorer', function () {
            return $this->app->make(ElasticEngine::class);
        });
    }
}
