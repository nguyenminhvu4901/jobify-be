<?php

namespace App\Entities\ProfileSeries\UserLocation;

use App\Entities\ProfileSeries\UserLocation\Traits\UserLocationRelationship;
use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserLocation extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserLocationRelationship;

    protected $table = UserLocationEnum::TABLE->value;

    protected $with = ['province', 'district', 'ward'];

    public const FILLABLE_FIELDS = [
        'user_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
