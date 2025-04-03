<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProduct;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Observers\BaseObserver;

class UserProductObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProduct::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
