<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserEducation;
use App\Enums\RouteNames\Profile\UserProfile;

class UserEducationObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserEducation::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
