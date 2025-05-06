<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Observers\BaseObserver;

class UserProfileObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProfileEnum::TAG_NAME->value,

        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value,
        CompanyBenefitEnum::TAG_NAME->value,

        JobListingEnum::TAG_NAME->value,

        JobApplicationEnum::TAG_NAME->value,
    ];
}
