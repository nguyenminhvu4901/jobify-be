<?php

namespace App\Entities\JobSeries\JobExperience\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobExperienceTrait
{
    use TransformableTrait, HasFactory, JobExperienceAttribute;

}
