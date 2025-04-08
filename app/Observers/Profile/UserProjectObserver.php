<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Observers\BaseObserver;

class UserProjectObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProjectEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
