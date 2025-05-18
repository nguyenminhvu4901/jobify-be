<?php

namespace App\Http\Requests\JobSeries\JobListing;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobGetRequest extends FormRequest
{
    use FailedValidation, NormalizeDateTrait;
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
            JobListingEnum::PREFIX->value . JobListingEnum::LIST_ALL_JOBS_BY_COMPANY->value => [
                'company_id' => ['bail', 'required', 'integer', 'exists:companies,id']
            ],
            JobListingEnum::PREFIX->value . JobListingEnum::DETAIL_JOB_BY_JOB_ID->value => [
                'job_id' => ['bail', 'required', 'integer', 'exists:job_listings,id']
            ],
            default => [],
        };
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['publish_date', 'expiry_date', 'created_at', 'updated_at']);
    }
}
