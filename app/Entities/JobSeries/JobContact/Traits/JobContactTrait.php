<?php

namespace App\Entities\JobSeries\JobContact\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobContactTrait
{
    use TransformableTrait, HasFactory, JobContactRelationship, JobContactScope;
}
