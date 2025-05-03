<?php

namespace App\Rules\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\JobSalary;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class SalaryBelongsToJobListingRule implements ValidationRule
{
    public function __construct(
        protected int $jobListingId
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExists = JobSalary::whereByJobListingId($this->jobListingId)
            ->where('id', $value)
            ->doesntExist();

        if($checkExists){
            $fail(__('validation.custom.salary_not_belongs_to_job'));
        }
    }
}
