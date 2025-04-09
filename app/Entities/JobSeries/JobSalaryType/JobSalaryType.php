<?php

namespace App\Entities\JobSeries\JobSalaryType;

use App\Enums\RouteNames\JobSeries\JobSalaryTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobSalaryType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobSalaryTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type'
    ];

    /**
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_salary_types.type', $value)
        );
    }
}
