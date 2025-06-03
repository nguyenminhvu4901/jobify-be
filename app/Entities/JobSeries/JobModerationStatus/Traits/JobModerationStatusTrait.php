<?php

namespace App\Entities\JobSeries\JobModerationStatus\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobModerationStatusTrait
{
    use TransformableTrait, HasFactory, JobModerationStatusAttribute;
}
