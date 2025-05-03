<?php

namespace App\Rules\Resource;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class UniqueArrayValues implements ValidationRule
{
    public function __construct(
        protected ?string $requestName
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $values = request()->input($this->requestName);

        if (! is_array($values)) {
            return;
        }

        $filtered = array_map('intval', array_filter($values));

        if (count($filtered) !== count(array_unique($filtered))) {
            $fail(__('validation.custom.invalid_attachment_duplicate'));
        }
    }
}
