<?php

namespace App\Rules\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CompanyBelongsToJobListingRule implements ValidationRule
{
    public function __construct(
        protected ?int $companyId
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $checkExists = JobListing::checkExistCompanyIdAndJobId($this->companyId, $value);

        if (! $checkExists) {
            $fail(__('validation.custom.job_listing_detail_not_belongs_to_company'));
        }
    }
}
