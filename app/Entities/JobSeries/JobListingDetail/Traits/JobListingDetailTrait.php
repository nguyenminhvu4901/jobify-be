<?php

namespace App\Entities\JobSeries\JobListingDetail\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobListingDetailTrait
{
    use TransformableTrait, HasFactory, JobListingDetailScope;
}
