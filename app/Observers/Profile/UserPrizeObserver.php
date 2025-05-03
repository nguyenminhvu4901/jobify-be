<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserPrizeObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserPrizeEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
