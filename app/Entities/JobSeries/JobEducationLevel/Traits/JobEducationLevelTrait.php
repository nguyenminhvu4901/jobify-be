<?php

namespace App\Entities\JobSeries\JobEducationLevel\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobEducationLevelTrait
{
    use TransformableTrait, HasFactory, JobEducationLevelAttribute;
}
