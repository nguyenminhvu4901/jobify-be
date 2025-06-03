<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CompanyWorkingDayAttribute
{
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
