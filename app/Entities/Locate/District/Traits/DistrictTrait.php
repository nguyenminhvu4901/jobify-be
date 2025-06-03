<?php

namespace App\Entities\Locate\District\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait DistrictTrait
{
    use TransformableTrait, HasFactory,
        DistrictRelationship, DistrictScope;
}
