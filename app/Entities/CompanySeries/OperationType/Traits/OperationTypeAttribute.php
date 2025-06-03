<?php

namespace App\Entities\CompanySeries\OperationType\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait OperationTypeAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => translatable_or_original('data/company_series/operation_types.name', $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => translatable_or_original('data/company_series/operation_types.description', $value)
        );
    }
}
