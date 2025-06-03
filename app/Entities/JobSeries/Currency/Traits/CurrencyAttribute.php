<?php

namespace App\Entities\JobSeries\Currency\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CurrencyAttribute
{
    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }
}
