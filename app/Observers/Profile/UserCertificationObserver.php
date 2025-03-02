<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCertification;

class UserCertificationObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserCertification::TAG_NAME->value;
}
