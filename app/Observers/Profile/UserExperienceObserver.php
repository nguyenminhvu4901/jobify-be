<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserExperience;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserExperienceObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserExperience::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
