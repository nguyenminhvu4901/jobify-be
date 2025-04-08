<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserActivityObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserActivityEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
