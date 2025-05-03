<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Observers\BaseObserver;

class UserSkillObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserSkillEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value,
    ];
}
