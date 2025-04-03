<?php

namespace App\Enums\RouteNames\Company;

enum BusinessSector: string
{
    case PREFIX = 'company.businessSector.';

    case TAG_NAME = 'businessSectors';

    case LIST_ALL_BUSINESS_SECTOR = 'listAllBusinessSector';
}
