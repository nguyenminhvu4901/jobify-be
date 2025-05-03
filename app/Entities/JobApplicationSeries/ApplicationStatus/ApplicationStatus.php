<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus;

use App\Entities\JobApplicationSeries\ApplicationStatus\Traits\ApplicationStatusRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobListing\JobListing> $jobListings
 * @property-read int|null $job_listings_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApplicationStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ApplicationStatus extends BaseModel implements Transformable
{
    use ApplicationStatusRelationship;
    use HasFactory;
    use TransformableTrait;

    protected $table = 'application_statuses';

    public const FILLABLE_FIELDS = [
        'name', 'description',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => translatable_or_original('data/job_application_series/application_statuses.name', $value)
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => translatable_or_original('data/job_application_series/application_statuses.description', $value)
        );
    }
}
