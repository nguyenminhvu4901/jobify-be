<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\Company\CompanyBranchEnum;
use App\Enums\RouteNames\Company\CompanyProfileEnum;
use App\Observers\BaseObserver;

class CompanyBranchObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value
    ];
}
