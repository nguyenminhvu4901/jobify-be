<?php

namespace App\Entities\DefaultSeries\DefaultRate;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultRate extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'default_rates';

    public const FILLABLE_FIELDS = [
        'rate'
    ];
}
