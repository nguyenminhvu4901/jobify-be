<?php

namespace App\Entities\JobApplicationSeries\ApplicationCV\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait ApplicationCVTrait
{
    use TransformableTrait, HasFactory, ApplicationCVRelationship;
}
