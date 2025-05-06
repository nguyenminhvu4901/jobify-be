<?php

namespace App\Observers\JobSeries;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Observers\BaseObserver;

class JobListingObserver extends BaseObserver
{
    protected array $cacheTag = [
        JobListingEnum::TAG_NAME->value,

        JobApplicationEnum::TAG_NAME->value
    ];
}
