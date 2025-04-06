<?php

namespace App\Enums\RouteNames\Company;

enum CompanyBranch: string
{
    case PREFIX = 'company.profile.companyBranch.';

    case TAG_NAME = 'companies';

    case LIST_COMPANY_BRANCH = 'listCompanyBranch';

    case STORE_COMPANY_BRANCH = 'storeCompanyBranch';

    case UPDATE_COMPANY_BRANCH = 'updateCompanyBranch';

    case DESTROY_COMPANY_BRANCH = 'destroyCompanyBranch';
}
