<?php

namespace App\Entities\ProfileSeries\UserExperience;

use App\Entities\ProfileSeries\UserExperience\Traits\UserExperienceTraits;
use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserExperience extends BaseModel implements Transformable
{
    use UserExperienceTraits;

    protected $table = UserExperienceEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'is_working',
        'start_date',
        'end_date'
    ];
}
