<?php

namespace App\Entities\ProfileSeries\UserExperienceResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserExperienceResourceTrait
{
    use TransformableTrait, HasFactory, UserExperienceResourceRelationship;
}
