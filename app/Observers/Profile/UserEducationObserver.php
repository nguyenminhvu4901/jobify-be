<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserEducation;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserEducationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserEducation::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
