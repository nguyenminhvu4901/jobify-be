<?php

namespace App\Entities\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\Traits\JobLevelRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobLevelRelationship;

    protected $table = 'job_levels';

    public const FILLABLE_FIELDS = [
        'title', 'description'
    ];

    /**
     * @return Attribute
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return __('data/job_series/job_levels.title.' . $value) ?? $value;
            }
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return __('data/job_series/job_levels.description.' . $value) ?? $value;
            }
        );
    }
}
