<?php

namespace App\Enums\RouteNames\Company;

enum CompanyWorkingDay: string
{
    case PREFIX = 'company.companyWorkingDay.';

    case TAG_NAME = 'workingDays';

    case LIST_ALL_WORKING_DAY = 'listAllWorkingDay';
}
