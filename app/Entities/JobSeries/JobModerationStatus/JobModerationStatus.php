<?php

namespace App\Entities\JobSeries\JobModerationStatus;

use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobModerationStatus extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = JobModerationStatusEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_moderation_statuses.name', $value)
        );
    }
}
