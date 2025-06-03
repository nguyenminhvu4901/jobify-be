<?php

namespace App\Entities\JobSeries\JobModerationStatus\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobModerationStatusAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_moderation_statuses.name', $value)
        );
    }
}
