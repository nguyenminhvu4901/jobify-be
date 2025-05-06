<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Observers\BaseObserver;

class CompanyObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value,
        CompanyBenefitEnum::TAG_NAME->value,

        JobListingEnum::TAG_NAME->value,

        JobApplicationEnum::TAG_NAME->value,
    ];
}
