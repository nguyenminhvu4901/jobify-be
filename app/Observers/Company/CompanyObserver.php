<?php

namespace App\Observers\Company;

use App\Enums\RouteNames\Company\CompanyBranch;
use App\Enums\RouteNames\Company\CompanyProfile;
use App\Observers\BaseObserver;

class CompanyObserver extends BaseObserver
{
    protected array $cacheTag = [
        CompanyProfile::TAG_NAME->value,
        CompanyBranch::TAG_NAME->value
    ];
}
