<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = '/^\+?[0-9]{10,15}$/';

        if (!preg_match($regex, $value)) {
            $fail(__('validation.phone_rule', ['name' => 'phone_number']));
        }
    }
}
