<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserPrize;
use App\Enums\RouteNames\Profile\UserProfile;

class UserPrizeObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserPrize::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
