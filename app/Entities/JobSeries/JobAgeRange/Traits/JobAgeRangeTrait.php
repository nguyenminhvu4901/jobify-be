<?php

namespace App\Entities\JobSeries\JobAgeRange\Traits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobAgeRangeTrait
{
    use TransformableTrait, HasFactory, JobAgeRangeAttribute;
}
