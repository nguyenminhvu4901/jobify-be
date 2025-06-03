<?php

namespace App\Entities\ProfileSeries\UserProjectResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserProjectResourceTrait
{
    use TransformableTrait, HasFactory, UserProjectResourceRelationship;
}
