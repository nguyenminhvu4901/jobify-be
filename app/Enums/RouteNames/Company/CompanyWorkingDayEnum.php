<?php

namespace App\Enums\RouteNames\Company;

enum CompanyWorkingDayEnum: string
{
    case PREFIX = 'company.companyWorkingDay.';

    case TAG_NAME = 'workingDays';

    case TABLE = 'company_working_days';

    case LIST_ALL_WORKING_DAY = 'listAllWorkingDay';
}
