<?php

namespace App\Entities\JobSeries\JobVisibilityStatus\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobVisibilityStatusTrait
{
    use TransformableTrait, HasFactory, JobVisibilityStatusAttribute;
}
