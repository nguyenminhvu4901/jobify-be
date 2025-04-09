<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay;

use App\Enums\RouteNames\CompanySeries\CompanyWorkingDayEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyWorkingDay extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = CompanyWorkingDayEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'working_day'
    ];

    /**
     * @return Attribute
     */
    protected function workingDay(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => translatable_or_original('data/company_series/working_days', $value)
        );
    }

}
