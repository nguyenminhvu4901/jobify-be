<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserSkill;

class UserSkillObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserSkill::TAG_NAME->value;
}
