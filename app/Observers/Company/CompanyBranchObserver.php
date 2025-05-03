<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Observers\BaseObserver;

class CompanyBranchObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value
    ];
}
