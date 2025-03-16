<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;

class UserProfileObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserProfile::TAG_NAME->value
    ];
}
