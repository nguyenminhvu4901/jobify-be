<?php

namespace App\Rules\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\JobContact;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class ContactBelongsToJobListingRule implements ValidationRule
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
        $checkExists = JobContact::whereByJobListingId($this->jobListingId)
            ->where('id', $value)
            ->doesntExist();

        if($checkExists){
            $fail(__('validation.custom.contact_not_belongs_to_job'));
        }
    }
}
