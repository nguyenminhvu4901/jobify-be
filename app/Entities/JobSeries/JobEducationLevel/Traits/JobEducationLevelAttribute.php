<?php

namespace App\Entities\JobSeries\JobEducationLevel\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobEducationLevelAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => translatable_or_original("data/job_series/job_education_levels.name", $value)
        );
    }
}
