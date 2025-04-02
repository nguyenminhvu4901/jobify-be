<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserActivity;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserActivityObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserActivity::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
