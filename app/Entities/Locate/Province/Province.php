<?php

namespace App\Entities\Locate\Province;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Province extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'provinces';

    public const FILLABLE_FIELDS = [
        'code',
        'province_name'
    ];
}
