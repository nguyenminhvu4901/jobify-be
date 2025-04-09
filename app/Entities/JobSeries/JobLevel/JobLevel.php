<?php

namespace App\Entities\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\Traits\JobLevelRelationship;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobLevelRelationship;

    protected $table = JobLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'title', 'description'
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            ($t = __('data/job_series/job_levels.title.' . $value)) !==
            'data/job_series/job_levels.title.' . $value
                ? $t
                : $value
        );
    }


    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/job_series/job_levels.description', $value)
        );
    }
}
