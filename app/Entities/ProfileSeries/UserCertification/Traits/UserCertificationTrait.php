<?php

namespace App\Entities\ProfileSeries\UserCertification\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserCertificationTrait
{
    use TransformableTrait, HasFactory, UserCertificationRelationship;
}
