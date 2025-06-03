<?php

namespace App\Entities\JobApplicationSeries\JobApplicationStatus\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobApplicationStatusTrait
{
    use TransformableTrait, HasFactory, JobApplicationStatusRelationship;
}
