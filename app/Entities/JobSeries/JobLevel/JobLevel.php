<?php

namespace App\Entities\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\Traits\JobLevelRelationship;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobLevelRelationship;

    protected $table = JobLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'title', 'description'
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            ($t = __('data/job_series/job_levels.title.' . $value)) !==
            'data/job_series/job_levels.title.' . $value
                ? $t
                : $value
        );
    }


    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/job_series/job_levels.description', $value)
        );
    }
}
