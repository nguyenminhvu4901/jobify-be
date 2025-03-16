<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Enums\RouteNames\Profile\UserSkill;

class UserSkillObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserSkill::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
