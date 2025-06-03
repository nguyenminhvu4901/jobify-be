<?php

namespace App\Entities\JobSeries\JobSalaryType\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobSalaryTypeAttribute
{
    /**
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_salary_types.type', $value)
        );
    }
}
