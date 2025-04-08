<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserLocationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserLocationEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
