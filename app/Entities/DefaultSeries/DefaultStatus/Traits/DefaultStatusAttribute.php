<?php

namespace App\Entities\DefaultSeries\DefaultStatus\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait DefaultStatusAttribute
{
    /**
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }
}
