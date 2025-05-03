<?php

namespace App\Rules\JobSeries\JobListingDetail;

use App\Entities\JobSeries\JobListingDetail\JobListingDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class JobListingDetailBelongsToJobListingRule implements ValidationRule
{
    public function __construct(
        protected ?int $jobListingId
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExists = JobListingDetail::whereByJobListingId($this->jobListingId)
            ->where('id', $value)
            ->doesntExist();

        if ($checkExists) {
            $fail(__('validation.custom.job_listing_detail_not_belongs_to_job'));
        }
    }
}
