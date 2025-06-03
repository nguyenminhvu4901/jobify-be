<?php

namespace App\Entities\JobSeries\JobAgeRange\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait JobAgeRangeAttribute
{
    protected function display(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                empty($this->min_age) && !empty($this->max_age) =>
                    __('data/job_series/job_age_ranges.age') . ' ' .
                    __('data/job_series/job_age_ranges.min') . ' ' . $this->max_age,

                empty($this->max_age) && !empty($this->min_age) =>
                    __('data/job_series/job_age_ranges.age') . ' ' .
                    __('data/job_series/job_age_ranges.max') . ' ' . $this->min_age,

                empty($this->max_age) && empty($this->min_age) => __('data/job_series/job_age_ranges.other'),

                default =>
                    __('data/job_series/job_age_ranges.age') . ' ' . $this->min_age . ' - ' . $this->max_age,
            }
        );
    }
}
