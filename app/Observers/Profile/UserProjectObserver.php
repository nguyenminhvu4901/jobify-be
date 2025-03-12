<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProject;

class UserProjectObserver extends BaseProfileObserver
{
    protected string $cacheTag = UserProject::TAG_NAME->value;
}
