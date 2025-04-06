<?php

namespace App\Entities\DefaultSeries\DefaultGender;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultGender extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "default_genders";

    public const FILLABLE_FIELDS = [
        'gender'
    ];
}
