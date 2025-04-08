<?php

namespace App\Entities\JobSeries\JobEducationLevel;

use App\Enums\RouteNames\JobSeries\JobEducationLevelEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobEducationLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobEducationLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = ['name'];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return __('data/job_series/job_education_levels.name.' . $value) ?? $value;
            }
        );
    }
}
