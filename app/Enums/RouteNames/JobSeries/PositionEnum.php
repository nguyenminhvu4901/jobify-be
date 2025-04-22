<?php

namespace App\Enums\RouteNames\JobSeries;

enum PositionEnum: string
{
    case PREFIX = 'job.position.';

    case TAG_NAME = 'position';

    case TABLE = 'positions';

    case LIST_ALL_POSITION = 'listAllPosition';

    case LIST_LEAF_POSITION = 'listLeafPosition';

    case MAIN_PRIORITY = '1';

    case SECONDARY_PRIORITY = '2';
}
