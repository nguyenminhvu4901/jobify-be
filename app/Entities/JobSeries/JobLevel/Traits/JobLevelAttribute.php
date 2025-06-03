<?php

namespace App\Entities\JobSeries\JobLevel\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobLevelAttribute
{
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            ($t = __('data/job_series/job_levels.title.' . $value)) !==
            'data/job_series/job_levels.title.' . $value
                ? $t
                : $value
        );
    }


    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/job_series/job_levels.description', $value)
        );
    }
}
