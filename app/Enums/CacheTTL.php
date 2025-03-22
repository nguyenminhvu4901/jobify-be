<?php

namespace App\Enums;

enum CacheTTL: int
{
    case REMEMBER = 3600; //seconds

    case HARD = 86400; //second
}
