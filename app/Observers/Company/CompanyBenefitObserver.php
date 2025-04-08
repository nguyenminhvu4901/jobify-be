<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\Company\CompanyBenefitEnum;
use App\Enums\RouteNames\Company\CompanyProfileEnum;
use App\Observers\BaseObserver;

class CompanyBenefitObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfileEnum::TAG_NAME->value,
        CompanyBenefitEnum::TAG_NAME->value
    ];
}
