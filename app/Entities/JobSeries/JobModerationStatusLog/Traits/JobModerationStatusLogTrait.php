<?php

namespace App\Entities\JobSeries\JobModerationStatusLog\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobModerationStatusLogTrait
{
    use TransformableTrait, HasFactory, JobModerationStatusLogRelationship;
}
