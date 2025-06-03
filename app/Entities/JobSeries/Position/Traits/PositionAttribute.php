<?php

namespace App\Entities\JobSeries\Position\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait PositionAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/positions.name', $value)
        );
    }
}
