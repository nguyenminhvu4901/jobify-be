<?php

namespace App\Enums\RouteNames\Company;

enum CompanyBenefit: string
{
    case PREFIX = 'company.profile.companyBenefit.';

    case TAG_NAME = 'companies';

    case LIST_COMPANY_BENEFIT = 'listCompanyBenefit';

    case STORE_COMPANY_BENEFIT = 'storeCompanyBenefit';

    case UPDATE_COMPANY_BENEFIT = 'updateCompanyBenefit';

    case DESTROY_COMPANY_BENEFIT = 'destroyCompanyBenefit';
}
