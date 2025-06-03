<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait ApplicationStatusTrait
{
    use TransformableTrait, HasFactory, ApplicationStatusRelationship, ApplicationStatusAttribute;
}
