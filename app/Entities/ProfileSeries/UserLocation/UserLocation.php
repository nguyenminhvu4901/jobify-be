<?php

namespace App\Entities\ProfileSeries\UserLocation;

use App\Entities\ProfileSeries\UserLocation\Traits\UserLocationTrait;
use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserLocation extends BaseModel implements Transformable
{
    use UserLocationTrait;

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
