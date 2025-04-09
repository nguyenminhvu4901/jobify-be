<?php

namespace App\Enums\RouteNames\JobSeries;

enum CurrencyEnum: string
{
    case PREFIX = 'job.currency.';

    case TAG_NAME = 'currency';

    case TABLE = 'currencies';

    case LIST_ALL_CURRENCY = 'listAllCurrency';
}
