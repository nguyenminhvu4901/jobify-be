<?php

namespace App\Entities\JobSeries\JobType;

use App\Entities\JobSeries\JobType\Traits\JobTypeRelationShip;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobTypeRelationShip;

    protected $table = JobTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type'
    ];

    /**
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_types.title', $value)
        );
    }
}
