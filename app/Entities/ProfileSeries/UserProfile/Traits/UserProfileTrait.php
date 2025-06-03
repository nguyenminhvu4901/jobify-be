<?php

namespace App\Entities\ProfileSeries\UserProfile\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserProfileTrait
{
    use TransformableTrait, HasFactory, UserProfileRelationship;
}
