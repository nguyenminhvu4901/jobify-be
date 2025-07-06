<?php

namespace App\Macros;

use Illuminate\Support\Collection;

class CollectionMacros
{
    public static function register(): void
    {
        Collection::macro('toUpper', function () {
            return $this->map(fn($value) => strtoupper($value));
        });
    }
}
