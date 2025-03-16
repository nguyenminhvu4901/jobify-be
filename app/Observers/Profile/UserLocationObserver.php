<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserLocation;
use App\Enums\RouteNames\Profile\UserProfile;

class UserLocationObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserLocation::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
