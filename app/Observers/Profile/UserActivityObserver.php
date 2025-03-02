<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserActivity;

class UserActivityObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserActivity::TAG_NAME->value;
}
