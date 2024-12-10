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
            $fail('Số điện thoại không hợp lệ. Phải từ 10-15 chữ số và có thể bắt đầu bằng dấu "+".');
        }
    }
}
