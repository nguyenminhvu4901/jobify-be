<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserExperienceObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserExperienceEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
