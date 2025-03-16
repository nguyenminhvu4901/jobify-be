<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Enums\RouteNames\Profile\UserProject;

class UserProjectObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserProject::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
