<?php

namespace App\Entities\JobSeries\Currency;

use App\Entities\JobSeries\Currency\Traits\CurrencyRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Currency extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CurrencyRelationship;

    protected $table = 'currencies';

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
