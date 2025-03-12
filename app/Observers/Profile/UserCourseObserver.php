<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCourse;

class UserCourseObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserCourse::TAG_NAME->value;
}
