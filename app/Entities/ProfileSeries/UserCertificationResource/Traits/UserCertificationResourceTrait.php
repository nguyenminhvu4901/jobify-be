<?php

namespace App\Entities\ProfileSeries\UserCertificationResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserCertificationResourceTrait
{
    use TransformableTrait, HasFactory, UserCertificationResourceRelationship;
}
