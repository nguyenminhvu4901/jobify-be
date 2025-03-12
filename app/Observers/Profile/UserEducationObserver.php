<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserEducation;

class UserEducationObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserEducation::TAG_NAME->value;
}
