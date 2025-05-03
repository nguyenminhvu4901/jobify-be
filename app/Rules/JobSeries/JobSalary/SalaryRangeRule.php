<?php

namespace App\Rules\JobSeries\JobSalary;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SalaryRangeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/job_salaries\.(\d+)\.to/', $attribute, $matches);
        $index = $matches[1] ?? null;

        if (!is_null($index)) {
            $from = request()->input("job_salaries.$index.from");

            if (!is_null($from) && !is_null($value) && $value <= $from) {
                $fail(__('validation.custom.job_salaries_greater_than_from'));
            }
        }
    }
}
