<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCourse;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserCourseObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserCourse::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
