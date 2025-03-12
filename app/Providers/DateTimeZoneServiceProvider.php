<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DateTimeZoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
}
