<?php

namespace App\Enums\RouteNames\Company;

enum CompanyBenefitEnum: string
{
    case PREFIX = 'company.profile.companyBenefit.';

    case TAG_NAME = 'companies';

    case TABLE = 'company_benefits';

    case LIST_COMPANY_BENEFIT = 'listCompanyBenefit';

    case STORE_COMPANY_BENEFIT = 'storeCompanyBenefit';

    case UPDATE_COMPANY_BENEFIT = 'updateCompanyBenefit';

    case DESTROY_COMPANY_BENEFIT = 'destroyCompanyBenefit';
}
