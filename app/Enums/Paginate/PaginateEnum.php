<?php

namespace App\Enums\Paginate;

enum PaginateEnum: int
{
    case CURSOR_PAGINATE_POSITION = 4;

    case PAGINATE_DEFAULT = 15;
}
