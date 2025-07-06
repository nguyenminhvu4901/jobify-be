<?php

namespace App\Macros;

use Illuminate\Support\Str;

class StrMacros
{
    public static function register(): void
    {
        Str::macro('toSlug', fn (string $string) => Str::slug($string));
        Str::macro('toTitleCaseSlug', function (string $string): string {
            return collect(explode('-', Str::slug($string)))
                ->map(fn ($word) => ucfirst($word))
                ->implode('-');
        });
    }
}
