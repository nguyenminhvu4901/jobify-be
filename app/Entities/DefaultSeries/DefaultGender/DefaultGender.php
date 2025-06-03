<?php

namespace App\Entities\DefaultSeries\DefaultGender;

use App\Entities\DefaultSeries\DefaultGender\Traits\DefaultGenderTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class DefaultGender extends BaseModel implements Transformable
{
    use DefaultGenderTrait;

    protected $table = "default_genders";

    public const FILLABLE_FIELDS = [
        'gender'
    ];
}
