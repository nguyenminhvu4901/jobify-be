<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserCertificationObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserCertificationEnum::TAG_NAME->value,
        UserProfileEnum::TAG_NAME->value,
    ];
}
