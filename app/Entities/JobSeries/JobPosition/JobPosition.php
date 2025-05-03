<?php

namespace App\Entities\JobSeries\JobPosition;

use App\Entities\JobSeries\JobPosition\Traits\JobPositionRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $job_listing_id
 * @property int|null $position_id
 * @property int|null $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPosition whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobPosition extends BaseModel implements Transformable
{
    use HasFactory;
    use JobPositionRelationship;
    use TransformableTrait;

    protected $table = 'job_position';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'position_id',
        'priority',
    ];
}
