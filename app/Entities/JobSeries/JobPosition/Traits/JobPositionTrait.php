<?php

namespace App\Entities\JobSeries\JobPosition\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobPositionTrait
{
    use TransformableTrait, HasFactory, JobPositionRelationship;
}
