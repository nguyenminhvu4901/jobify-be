<?php

namespace App\Entities\Locate\District;

use App\Entities\Locate\District\Traits\DistrictRelationship;
use App\Entities\Locate\District\Traits\DistrictScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class District extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory,
        DistrictRelationship, DistrictScope;

    protected $table = 'districts';

    public const FILLABLE_FIELDS = [
        'province_id',
        'code',
        'district_name'
    ];
}
