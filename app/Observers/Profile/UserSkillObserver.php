<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Enums\RouteNames\Profile\UserSkill;
use App\Observers\BaseObserver;

class UserSkillObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserSkill::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
