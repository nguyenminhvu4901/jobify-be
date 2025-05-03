<?php

namespace App\Entities\JobSeries\JobEducationLevel;

use App\Enums\RouteNames\JobSeries\JobEducationLevelEnum;
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobEducationLevel whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobEducationLevel extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = JobEducationLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = ['name'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => translatable_or_original('data/job_series/job_education_levels.name', $value)
        );
    }
}
