<?php

namespace App\Entities\JobSeries\JobType\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobTypeAttribute
{
    /**
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_types.title', $value)
        );
    }
}
