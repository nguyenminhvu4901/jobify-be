<?php

namespace App\Enums\SearchFullText;

enum FullTextMode: string
{
    case NATURAL_LANGUAGE_MODE = 'NATURAL LANGUAGE MODE';

    case BOOLEAN_MODE = 'BOOLEAN MODE';

    case QUERY_EXPANSION = 'QUERY EXPANSION';
}
