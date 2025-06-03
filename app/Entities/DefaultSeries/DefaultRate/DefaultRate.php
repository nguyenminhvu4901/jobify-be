<?php

namespace App\Entities\DefaultSeries\DefaultRate;

use App\Entities\DefaultSeries\DefaultRate\Traits\DefaultRateTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class DefaultRate extends BaseModel implements Transformable
{
    use DefaultRateTrait;

    protected $table = 'default_rates';

    public const FILLABLE_FIELDS = [
        'rate'
    ];
}
