<?php

namespace App\Rules\JobSeries\JobSalary;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SalaryRangeRule implements ValidationRule
{
    public function __construct(
        protected int|float|null $from
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_null($this->from) && !is_null($value) && $value <= $this->from) {
            $fail(__('validation.custom.job_salaries_greater_than_from'));
        }
    }
}
