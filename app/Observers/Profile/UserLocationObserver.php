<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserLocation;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserLocationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserLocation::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
