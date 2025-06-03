<?php

namespace App\Entities\ProfileSeries\UserProject;

use App\Entities\ProfileSeries\UserProject\Traits\UserProjectTrait;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserProject extends BaseModel implements Transformable
{
    use UserProjectTrait;

    protected $table = UserProjectEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'client',
        'member',
        'position',
        'mission',
        'technology',
        'is_working',
        'start_date',
        'end_date',
        'description'
    ];
}
