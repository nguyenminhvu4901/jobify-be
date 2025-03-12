<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserExperience;

class UserExperienceObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserExperience::TAG_NAME->value;
}
