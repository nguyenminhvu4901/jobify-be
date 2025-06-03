<?php

namespace App\Entities\Locate\District;

use App\Entities\Locate\District\Traits\DistrictTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class District extends BaseModel implements Transformable
{
    use DistrictTrait;

    protected $table = 'districts';

    public const FILLABLE_FIELDS = [
        'province_id',
        'code',
        'district_name'
    ];
}
