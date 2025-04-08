<?php

namespace App\Enums\RouteNames\CompanySeries;

enum CompanyBranchEnum: string
{
    case PREFIX = 'company.profile.companyBranch.';

    case TAG_NAME = 'companies';

    case TABLE = 'company_branches';

    case LIST_COMPANY_BRANCH = 'listCompanyBranch';

    case STORE_COMPANY_BRANCH = 'storeCompanyBranch';

    case UPDATE_COMPANY_BRANCH = 'updateCompanyBranch';

    case DESTROY_COMPANY_BRANCH = 'destroyCompanyBranch';
}
