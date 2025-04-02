<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProfile::TAG_NAME->value
    ];
}
