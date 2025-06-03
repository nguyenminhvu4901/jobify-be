<?php

namespace App\Entities\ProfileSeries\UserProduct\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserProductTrait
{
    use TransformableTrait, HasFactory, UserProductRelationship;
}
