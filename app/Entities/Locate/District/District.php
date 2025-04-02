<?php

namespace App\Entities\Locate\District;

use App\Entities\Locate\District\Traits\DistrictRelationship;
use App\Entities\Locate\District\Traits\DistrictScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class District extends Model implements Transformable
{
    use TransformableTrait, HasFactory,
        DistrictRelationship, DistrictScope;

    protected $table = 'districts';

    protected $fillable = [
        'province_id',
        'code',
        'district_name'
    ];
}
