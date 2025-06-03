<?php

namespace App\Entities\ProfileSeries\UserSkill\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserSkillTrait
{
    use TransformableTrait, HasFactory, UserSkillRelationship;
}
