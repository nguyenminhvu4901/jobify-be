<?php

namespace App\Enums\RouteNames\JobSeries;

enum PositionEnum: string
{
    case PREFIX = 'job.position.';

    case TAG_NAME = 'position';

    case TABLE = 'positions';

    case LIST_ALL_POSITION = 'listAllPosition';
}
