<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay;

use App\Enums\RouteNames\CompanySeries\CompanyWorkingDayEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property string $working_day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyWorkingDay whereWorkingDay($value)
 *
 * @mixin \Eloquent
 */
class CompanyWorkingDay extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $table = CompanyWorkingDayEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'working_day',
    ];

    protected function workingDay(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/company_series/working_days', $value)
        );
    }
}
