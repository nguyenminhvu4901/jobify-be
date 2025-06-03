<?php

namespace App\Entities\Locate\Province;

use App\Entities\Locate\Province\Traits\ProvinceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class Province extends BaseModel implements Transformable
{
    use ProvinceTrait;

    protected $table = 'provinces';

    public const FILLABLE_FIELDS = [
        'code',
        'province_name'
    ];
}
