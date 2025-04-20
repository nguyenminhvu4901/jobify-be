<?php

namespace App\Entities\JobSeries\JobModerationStatus;

use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobModerationStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobModerationStatusEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_moderation_statuses.name', $value)
        );
    }
}
