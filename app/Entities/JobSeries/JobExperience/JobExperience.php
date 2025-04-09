<?php

namespace App\Entities\JobSeries\JobExperience;

use App\Enums\RouteNames\JobSeries\JobExperienceEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobExperience extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobExperienceEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original("data/job_series/job_experiences.name", $value)
        );
    }

}
