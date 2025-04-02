<?php

namespace App\Enums\RouteNames\Company;

enum CompanyBranch: string
{
    case PREFIX = 'company.profile.branch.';

    case TAG_NAME = 'companies';

    case UPDATE_COMPANY_BRANCH = 'updateCompanyBranch';

    case STORE_COMPANY_BRANCH = 'storeCompanyBranch';
}
