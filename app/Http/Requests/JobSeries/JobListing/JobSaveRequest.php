<?php

namespace App\Http\Requests\JobSeries\JobListing;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Rules\JobSeries\JobSalary\SalaryRangeRule;
use App\Rules\PhoneNumberRule;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobSaveRequest extends FormRequest
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

        return match ($routeName){
            JobListingEnum::PREFIX->value . JobListingEnum::STORE_JOB->value => [
               ...$this->getCommonRules()
            ],

            JobListingEnum::PREFIX->value . JobListingEnum::UPDATE_JOB->value => [
                ...$this->getCommonRules(),
                'job_listing_id' => ['bail', 'required', 'integer', 'exists:job_listings,id'],
                'job_salaries.*.job_salary_id' => [
                    'bail', 'nullable', 'integer', 'exists:job_salaries,id'
                ],
                'job_locations.*.job_location_id' => [
                    'bail', 'nullable', 'integer', 'exists:job_locations,id'
                ],
                'job_contacts.*.job_contact_id' => [
                    'bail', 'nullable', 'integer', 'exists:job_contacts,id'
                ],
                'job_listing_details.*.job_listing_detail_id' => [
                    'bail', 'nullable', 'integer', 'exists:job_listing_details,id'
                ],
            ],
            default => [],
        };
    }

    private function getCommonRules(): array
    {
        return [
            'company_id' => ['bail', 'required', 'integer', 'exists:companies,id'],
            'title' => ['bail', 'required', 'string', 'max:255'],
            'quantity_recruitment' => ['bail', 'required', 'integer', 'min:0'],
            'gender_id' => ['bail', 'required', 'integer', 'exists:default_genders,id'],
            'publish_date' => ['bail', 'required', 'date', 'after_or_equal:today'],
            'expiry_date' => ['bail', 'required', 'date', 'after:publish_date'],

            'job_salaries' => ['bail', 'required', 'array', 'size:1'],
            'job_salaries.0.currency_id' => [
                'bail', 'required', 'integer', 'exists:currencies,id'
            ],
            'job_salaries.0.job_salary_type_id' => [
                'bail', 'required', 'integer', 'exists:job_salary_types,id'
            ],
            'job_salaries.0.from' => [
                'bail', 'nullable', 'numeric', 'min:0'
            ],
            'job_salaries.0.to' => [
                'bail', 'nullable', 'numeric', 'min:0',
                new SalaryRangeRule($this->input('job_salaries.0.from'))
            ],

            'job_visibility_status_id' => [
                'bail', 'required', 'integer', 'in:1,2',
                'exists:job_visibility_statuses,id'
            ],

            'job_type_id' => [
                'bail', 'nullable', 'integer', 'exists:job_types,id',
            ],
            'job_level_id' => [
                'bail', 'nullable', 'integer', 'exists:job_levels,id',
            ],
            'job_experience_id' => [
                'bail', 'nullable', 'integer', 'exists:job_experiences,id',
            ],
            'job_age_range_id' => [
                'bail', 'nullable', 'integer', 'exists:job_age_ranges,id',
            ],
            'job_education_level_id' => [
                'bail', 'nullable', 'integer', 'exists:job_education_levels,id',
            ],

            'job_locations' => ['bail', 'required', 'array'],
            'job_locations.*.branch_name' => [
                'bail', 'required', 'string', 'max:255'
            ],
            'job_locations.*.province_id' => [
                'bail', 'required', 'integer', 'exists:provinces,id'
            ],
            'job_locations.*.district_id' => [
                'bail', 'required', 'integer', 'exists:districts,id'
            ],
            'job_locations.*.ward_id' => [
                'bail', 'nullable', 'integer', 'exists:wards,id'
            ],
            'job_locations.*.address' => [
                'bail', 'nullable', 'string', 'max:255'
            ],

            'job_position_main_id' => [
                'bail', 'required', 'integer', 'exists:positions,id'
            ],

            'job_position_secondary' => [
                'bail', 'nullable', 'array', 'size:2'
            ],
            'job_position_secondary.*' => [
                'bail', 'nullable', 'integer', 'exists:positions,id'
            ],

            'job_contacts' => [
                'bail', 'nullable', 'array'
            ],
            'job_contacts.*.full_name' => [
                'bail', 'required', 'string', 'max:255'
            ],
            'job_contacts.*.email' => [
                'bail', 'required', 'string', 'email', 'max:255'
            ],
            'job_contacts.*.phone_number' => [
                'bail', 'required', 'string', new PhoneNumberRule()
            ],

            'job_listing_details' => [
                'bail', 'nullable', 'array', 'size:1'
            ],
            'job_listing_details.0.description' => [
                'bail', 'nullable', 'string', 'max:16000'
            ],
            'job_listing_details.0.requirement' => [
                'bail', 'nullable', 'string', 'max:16000'
            ],
            'job_listing_details.0.income' => [
                'bail', 'nullable', 'string', 'max:16000'
            ],
            'job_listing_details.0.benefit' => [
                'bail', 'nullable', 'string', 'max:16000'
            ],
            'job_listing_details.0.working_hour' => [
                'bail', 'nullable', 'string', 'max:255'
            ],

            'min_age' => ['bail', 'nullable', 'integer', 'gt:0', 'lt:100'],
            'max_age' => ['bail', 'nullable', 'integer', 'gt:0', 'lt:100', 'gt:min_age'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['publish_date', 'expiry_date', 'created_at', 'updated_at']);
    }
}
