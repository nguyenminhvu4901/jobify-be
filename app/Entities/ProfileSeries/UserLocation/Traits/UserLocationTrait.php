<?php

namespace App\Entities\ProfileSeries\UserLocation\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserLocationTrait
{
    use TransformableTrait, HasFactory, UserLocationRelationship;
}
