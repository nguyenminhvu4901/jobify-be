<?php

namespace App\Http\Requests\JobSeries\JobListing;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Rules\JobSeries\JobListing\CompanyBelongsToJobListingRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobStatusRequest extends FormRequest
{
    use FailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $routeName = request()->route()->getName();

        return match ($routeName) {
            JobListingEnum::PREFIX->value.JobListingEnum::UPDATE_JOB_ACTIVE_STATUS->value => [
                ...$this->getCommonRules(),
                'active_status_id' => ['bail', 'required', 'integer', 'exists:default_statuses,id'],
            ],
            JobListingEnum::PREFIX->value.JobListingEnum::DESTROY_JOB->value => [
                ...$this->getCommonRules(),
            ],
        };
    }

    private function getCommonRules(): array
    {
        return [
            'company_id' => ['bail', 'required', 'integer', 'exists:companies,id'],
            'job_listing_id' => [
                'bail', 'required', 'integer', 'exists:job_listings,id',
                new CompanyBelongsToJobListingRule($this->input('company_id')),
            ],
        ];
    }
}
