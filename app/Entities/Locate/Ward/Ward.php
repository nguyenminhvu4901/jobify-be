<?php

namespace App\Entities\Locate\Ward;

use App\Entities\Locate\Ward\Traits\WardRelationship;
use App\Entities\Locate\Ward\Traits\WardScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Ward extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, WardRelationship, WardScope;

    protected $table = 'wards';

    public const FILLABLE_FIELDS = [
        'district_id',
        'code',
        'ward_name'
    ];
}
