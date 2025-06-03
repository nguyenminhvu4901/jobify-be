<?php

namespace App\Entities\ProfileSeries\UserExperience\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserExperienceTraits
{
    use TransformableTrait, HasFactory, UserExperienceRelationship, UserExperienceScope;
}
