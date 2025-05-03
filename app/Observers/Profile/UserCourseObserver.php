<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserCourseObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserCourseEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value
    ];
}
