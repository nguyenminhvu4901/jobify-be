<?php

namespace App\Providers;

use App\Entities\UserActivity\UserActivity;
use App\Entities\UserCertification\UserCertification;
use App\Models\User;
use App\Observers\Profile\UserActivityObserver;
use App\Observers\Profile\UserCertificationObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    protected array $observers = [
        User::class => UserObserver::class,
        UserActivity::class => UserActivityObserver::class,
        UserCertification::class => UserCertificationObserver::class
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        foreach ($this->observers as $model => $observer) {
            $model::observe($observer);
        }
    }
}
