<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserEducationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserEducationEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value,
    ];
}
