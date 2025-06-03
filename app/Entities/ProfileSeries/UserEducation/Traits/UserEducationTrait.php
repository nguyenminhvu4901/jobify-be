<?php

namespace App\Entities\ProfileSeries\UserEducation\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserEducationTrait
{
    use TransformableTrait, HasFactory, UserEducationRelationship;
}
