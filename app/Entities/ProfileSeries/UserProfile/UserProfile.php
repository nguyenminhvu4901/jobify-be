<?php

namespace App\Entities\ProfileSeries\UserProfile;

use App\Entities\ProfileSeries\UserProfile\Traits\UserProfileTrait;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserProfile extends BaseModel implements Transformable
{
    use UserProfileTrait;

    protected $table = UserProfileEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'position',
        'gender_id',
        'birth_date',
        'description'
    ];
}
