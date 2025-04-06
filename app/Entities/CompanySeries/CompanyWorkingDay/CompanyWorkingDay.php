<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyWorkingDay extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "company_working_days";

    public const FILLABLE_FIELDS = [
        'working_day'
    ];

    /**
     * @return Attribute
     */
    protected function workingDay(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (str_contains($value, '_')) {
                    return __('data/working_days.' . $value) ?? $value;
                }

                return $value;
            }
        );
    }
}
