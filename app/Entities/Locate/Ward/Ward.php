<?php

namespace App\Entities\Locate\Ward;

use App\Entities\Locate\Ward\Traits\WardTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class Ward extends BaseModel implements Transformable
{
    use WardTrait;

    protected $table = 'wards';

    public const FILLABLE_FIELDS = [
        'district_id',
        'code',
        'ward_name'
    ];
}
