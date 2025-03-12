<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProduct;

class UserProductObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserProduct::TAG_NAME->value;
}
