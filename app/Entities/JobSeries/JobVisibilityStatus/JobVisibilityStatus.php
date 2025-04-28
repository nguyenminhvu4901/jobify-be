<?php

namespace App\Entities\JobSeries\JobVisibilityStatus;

use App\Enums\RouteNames\JobSeries\JobVisibilityStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobVisibilityStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobVisibilityStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobVisibilityStatusEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_visibility_statuses.name', $value)
        );
    }
}
