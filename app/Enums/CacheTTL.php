<?php

namespace App\Enums;

enum CacheTTL: int
{
    case REMEMBER = 3600; //seconds

    case HARD = 604800; //second 1 week
}
