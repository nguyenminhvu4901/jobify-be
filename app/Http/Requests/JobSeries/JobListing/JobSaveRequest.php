<?php

namespace App\Http\Requests\JobSeries\JobListing;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Rules\JobSeries\JobSalary\SalaryRangeRule;
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

            'job_salaries' => ['bail', 'nullable', 'array', 'size:1'],
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
