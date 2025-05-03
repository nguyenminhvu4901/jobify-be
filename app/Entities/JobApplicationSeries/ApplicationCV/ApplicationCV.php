<?php

namespace App\Entities\JobApplicationSeries\ApplicationCV;

use App\Entities\JobApplicationSeries\ApplicationCV\Traits\ApplicationCVRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $job_application_id
 * @property string $title
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\JobApplicationSeries\JobApplication\JobApplication|null $jobApplications
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV whereJobApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationCV whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ApplicationCV extends BaseModel implements Transformable
{
    use ApplicationCVRelationship;
    use HasFactory;
    use TransformableTrait;

    protected $table = 'application_cv';

    public const FILLABLE_FIELDS = [
        'title', 'path', 'job_application_id',
    ];
}
