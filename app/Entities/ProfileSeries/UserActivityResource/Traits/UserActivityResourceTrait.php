<?php

namespace App\Entities\ProfileSeries\UserActivityResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserActivityResourceTrait
{
    use TransformableTrait, HasFactory, UserActivityResourceRelationship;
}
