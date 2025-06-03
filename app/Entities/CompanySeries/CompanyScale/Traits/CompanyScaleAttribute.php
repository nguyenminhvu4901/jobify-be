<?php

namespace App\Entities\CompanySeries\CompanyScale\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CompanyScaleAttribute
{
    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => translatable_or_original('data/company_series/company_scales', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function display(): Attribute
    {
        return Attribute::make(
            get: function () {
                return str_contains($this->name, '-')
                    ? str_replace('-', $this->description, $this->name)
                    : $this->description . " " . $this->name;
            }
        );
    }
}
