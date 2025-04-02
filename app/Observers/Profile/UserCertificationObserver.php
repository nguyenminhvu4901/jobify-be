<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCertification;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserCertificationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserCertification::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
