<?php

namespace App\Entities\ProfileSeries\UserPrize;

use App\Entities\ProfileSeries\UserPrize\Traits\UserPrizeTrait;
use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserPrize extends BaseModel implements Transformable
{
    use UserPrizeTrait;

    protected $table = UserPrizeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date'
    ];
}
