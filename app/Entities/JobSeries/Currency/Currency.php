<?php

namespace App\Entities\JobSeries\Currency;

use App\Entities\JobSeries\Currency\Traits\CurrencyTrait;
use App\Enums\RouteNames\JobSeries\CurrencyEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class Currency extends BaseModel implements Transformable
{
    use CurrencyTrait;

    protected $table = CurrencyEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
