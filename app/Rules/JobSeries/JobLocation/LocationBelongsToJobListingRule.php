<?php

namespace App\Rules\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\JobLocation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class LocationBelongsToJobListingRule implements ValidationRule
{
    public function __construct(
        protected int $jobListingId
    )
    {
    }
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExists = JobLocation::whereByJobListingId($this->jobListingId)
            ->where('id', $value)
            ->doesntExist();

        if($checkExists){
            $fail(__('validation.custom.location_not_belongs_to_job'));
        }
    }
}
