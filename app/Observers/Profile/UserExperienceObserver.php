<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserExperience;
use App\Enums\RouteNames\Profile\UserProfile;

class UserExperienceObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserExperience::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
