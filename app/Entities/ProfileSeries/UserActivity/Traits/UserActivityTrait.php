<?php

namespace App\Entities\ProfileSeries\UserActivity\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserActivityTrait
{
    use TransformableTrait, HasFactory, UserActivityRelationship;
}
