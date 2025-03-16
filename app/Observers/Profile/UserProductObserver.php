<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProduct;
use App\Enums\RouteNames\Profile\UserProfile;

class UserProductObserver extends BaseProfileObserver
{
    protected array $cacheTag = [
        UserProduct::TAG_NAME->value,
        UserProfile::TAG_NAME->value
    ];
}
