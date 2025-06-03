<?php

namespace App\Entities\JobSeries\JobLevel\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobLevelTrait
{
    use TransformableTrait, HasFactory, JobLevelRelationship, JobLevelAttribute;
}
