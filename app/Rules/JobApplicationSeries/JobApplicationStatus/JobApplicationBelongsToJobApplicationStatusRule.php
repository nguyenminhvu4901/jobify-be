<?php

namespace App\Rules\JobApplicationSeries\JobApplicationStatus;

use App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class JobApplicationBelongsToJobApplicationStatusRule implements ValidationRule
{
    public function __construct(
        public ?int $jobApplicationId
    ) {}

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($this->jobApplicationId)) {
            $fail(__('validation.custom.job_application_not_found'));
            return;
        }

        $exists = JobApplicationStatus::where('id', $value)
            ->where('job_application_id', $this->jobApplicationId)
            ->exists();

        if (!$exists) {
            $fail(__('validation.custom.job_application_status_not_belongs_to_application'));
        }
    }
}
