<?php

namespace App\Entities\ProfileSeries\UserActivity;

use App\Entities\ProfileSeries\UserActivity\Traits\UserActivityTrait;
use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserActivity extends BaseModel implements Transformable
{
    use UserActivityTrait;

    protected $table = UserActivityEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'start_date',
        'end_date',
        'description'
    ];
}
