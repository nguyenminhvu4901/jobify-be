<?php

namespace App\Entities\JobSeries\JobLocation\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobLocationTrait
{
    use TransformableTrait, HasFactory, JobLocationRelationship, JobLocationScope;
}
