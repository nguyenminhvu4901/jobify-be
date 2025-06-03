<?php

namespace App\Entities\CompanySeries\BusinessSector\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait BusinessSectorAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/company_series/business_sectors.name', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>
            translatable_or_original('data/company_series/business_sectors.description', $value)
        );
    }
}
