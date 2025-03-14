<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserLocation;

class UserLocationObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserLocation::TAG_NAME->value;
}
