<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserPrize;

class UserPrizeObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserPrize::TAG_NAME->value;
}
