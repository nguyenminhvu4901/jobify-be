<?php

namespace App\Enums\RouteNames\Company;

enum CompanyScaleEnum: string
{
    case PREFIX = 'company.companyScale.';

    case TAG_NAME = 'companyScales';

    case TABLE = 'company_scales';

    case LIST_ALL_COMPANY_SCALE = 'listAllCompanyScale';
}
