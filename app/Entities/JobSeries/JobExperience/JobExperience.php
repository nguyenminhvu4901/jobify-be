<?php

namespace App\Entities\JobSeries\JobExperience;

use App\Enums\RouteNames\JobSeries\JobExperienceEnum;
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobExperience whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobExperience extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = JobExperienceEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_experiences.name', $value)
        );
    }
}
