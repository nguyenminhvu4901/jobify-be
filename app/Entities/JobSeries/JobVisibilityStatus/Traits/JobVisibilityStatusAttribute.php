<?php

namespace App\Entities\JobSeries\JobVisibilityStatus\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobVisibilityStatusAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_visibility_statuses.name', $value)
        );
    }
}
