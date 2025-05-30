<?php

namespace App\Rules\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MaxJobAppliesRule implements ValidationRule
{
    public function __construct(
        protected int|null $jobListingId,
        protected $maxApplies = JobApplicationEnum::MAX_APPLIES->value
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
        $count = app(JobApplicationRepository::class)->countJobApply($this->jobListingId, $value);

        if(!($count < $this->maxApplies)){
            $fail(__('validation.custom.max_job_applies', ['max' => $this->maxApplies]));
        }
    }
}
