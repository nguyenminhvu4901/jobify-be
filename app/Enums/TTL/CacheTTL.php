<?php

namespace App\Enums\TTL;

enum CacheTTL: int
{
    case REMEMBER = 3600; //seconds

    case HARD = 2592000; //second per month
}
