<?php

namespace App\Observers\JobApplicationSeries;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Observers\BaseObserver;

class JobApplicationObserver extends BaseObserver
{
    protected array $cacheTag = [
        JobApplicationEnum::TAG_NAME->value,
    ];
}
