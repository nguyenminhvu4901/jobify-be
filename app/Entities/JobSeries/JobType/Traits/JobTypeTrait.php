<?php

namespace App\Entities\JobSeries\JobType\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobTypeTrait
{
    use TransformableTrait, HasFactory, JobTypeRelationship, JobTypeAttribute;
}
