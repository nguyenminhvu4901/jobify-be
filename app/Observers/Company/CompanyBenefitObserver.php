<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\Company\CompanyBenefit;
use App\Enums\RouteNames\Company\CompanyProfile;
use App\Observers\BaseObserver;

class CompanyBenefitObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfile::TAG_NAME->value,
        CompanyBenefit::TAG_NAME->value
    ];
}
