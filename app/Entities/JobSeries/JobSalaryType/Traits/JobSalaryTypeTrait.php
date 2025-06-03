<?php

namespace App\Entities\JobSeries\JobSalaryType\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobSalaryTypeTrait
{
    use TransformableTrait, HasFactory, JobSalaryTypeAttribute;
}
