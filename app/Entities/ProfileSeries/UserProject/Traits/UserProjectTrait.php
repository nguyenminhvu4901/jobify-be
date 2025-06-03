<?php

namespace App\Entities\ProfileSeries\UserProject\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserProjectTrait
{
    use TransformableTrait, HasFactory, UserProjectRelationship;
}
