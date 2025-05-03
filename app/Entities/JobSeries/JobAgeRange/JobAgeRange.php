<?php

namespace App\Entities\JobSeries\JobAgeRange;

use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $min_age
 * @property int|null $max_age
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobAgeRange whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobAgeRange extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = JobAgeRangeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'min_age',
        'max_age',
    ];

    protected function display(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                empty($this->min_age) && ! empty($this->max_age) => __('data/job_series/job_age_ranges.age').' '.
                    __('data/job_series/job_age_ranges.min').' '.$this->max_age,

                empty($this->max_age) && ! empty($this->min_age) => __('data/job_series/job_age_ranges.age').' '.
                    __('data/job_series/job_age_ranges.max').' '.$this->min_age,

                empty($this->max_age) && empty($this->min_age) => __('data/job_series/job_age_ranges.other'),

                default => __('data/job_series/job_age_ranges.age').' '.$this->min_age.' - '.$this->max_age,
            }
        );
    }
}
