<?php

namespace App\Entities\ProfileSeries\UserSkill;

use App\Entities\ProfileSeries\UserSkill\Traits\UserSkillTrait;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserSkill extends BaseModel implements Transformable
{
    use UserSkillTrait;

    protected $table = UserSkillEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'rate_id',
        'description'
    ];
}
