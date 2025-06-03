<?php

namespace App\Entities\JobApplicationSeries\JobApplication\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobApplicationTrait
{
    use TransformableTrait, HasFactory, JobApplicationRelationship, JobApplicationScope;
}
