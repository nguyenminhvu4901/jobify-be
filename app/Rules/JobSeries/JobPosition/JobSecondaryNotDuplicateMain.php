<?php

namespace App\Rules\JobSeries\JobPosition;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class JobSecondaryNotDuplicateMain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $main = request()->input('job_position_main_id');
        if (in_array($main, $value ?? [])) {
            $fail(__('validation.custom.job_position_secondary_conflict'));
        }
    }
}
