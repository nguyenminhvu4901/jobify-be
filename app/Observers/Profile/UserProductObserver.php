<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserProductObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProductEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
