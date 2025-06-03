<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ApplicationStatusAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => translatable_or_original("data/job_application_series/application_statuses.name", $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => translatable_or_original("data/job_application_series/application_statuses.description", $value)
        );
    }
}
