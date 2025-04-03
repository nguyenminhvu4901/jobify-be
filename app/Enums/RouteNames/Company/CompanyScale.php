<?php

namespace App\Enums\RouteNames\Company;

enum CompanyScale: string
{
    case PREFIX = 'company.companyScale.';

    case TAG_NAME = 'companyScales';

    case LIST_ALL_COMPANY_SCALE = 'listAllCompanyScale';
}
