<?php

namespace App\Observers\JobApplicationSeries;

use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class JobApplicationObserver extends BaseObserver
{
    protected array $cacheTag = [
        JobApplicationEnum::TAG_NAME->value,

        UserProfileEnum::TAG_NAME->value,

        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value,
        CompanyBenefitEnum::TAG_NAME->value,

        JobListingEnum::TAG_NAME->value,
    ];
}
