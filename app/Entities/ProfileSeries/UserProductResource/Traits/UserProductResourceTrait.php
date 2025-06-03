<?php

namespace App\Entities\ProfileSeries\UserProductResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserProductResourceTrait
{
    use TransformableTrait, HasFactory, UserProductResourceRelationship;
}
