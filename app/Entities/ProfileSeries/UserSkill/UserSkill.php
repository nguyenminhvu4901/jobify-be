<?php

namespace App\Entities\ProfileSeries\UserSkill;

use App\Entities\ProfileSeries\UserSkill\Traits\UserSkillRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserSkill extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserSkillRelationship;

    protected $table = 'user_skills';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'rate_id',
        'description'
    ];
}
