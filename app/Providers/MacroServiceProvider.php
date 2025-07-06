<?php

namespace App\Providers;

use App\Macros\CollectionMacros;
use App\Macros\StrMacros;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        StrMacros::register();
        CollectionMacros::register();
    }
}
