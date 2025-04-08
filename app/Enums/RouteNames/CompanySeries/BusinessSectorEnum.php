<?php

namespace App\Enums\RouteNames\CompanySeries;

enum BusinessSectorEnum: string
{
    case PREFIX = 'company.businessSector.';

    case TAG_NAME = 'businessSectors';

    case TABLE = 'business_sectors';

    case LIST_ALL_BUSINESS_SECTOR = 'listAllBusinessSector';
}
