<?php

namespace App\Entities\JobSeries\JobType;

use App\Entities\JobSeries\JobType\Traits\JobTypeRelationShip;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobType extends BaseModel implements Transformable
{
    use HasFactory;
    use JobTypeRelationShip;
    use TransformableTrait;

    protected $table = JobTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type',
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_types.title', $value)
        );
    }
}
