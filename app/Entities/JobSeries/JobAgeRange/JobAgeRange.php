<?php

namespace App\Entities\JobSeries\JobAgeRange;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobAgeRange extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_age_ranges';

    public const FILLABLE_FIELDS = [
        'min_age',
        'max_age'
    ];

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
