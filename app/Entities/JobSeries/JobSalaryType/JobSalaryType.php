<?php

namespace App\Entities\JobSeries\JobSalaryType;

use App\Enums\RouteNames\JobSeries\JobSalaryTypeEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalaryType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobSalaryType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = JobSalaryTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type'
    ];

    /**
     * @return Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/job_salary_types.type', $value)
        );
    }
}
