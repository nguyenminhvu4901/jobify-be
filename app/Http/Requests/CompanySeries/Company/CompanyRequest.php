<?php

namespace App\Http\Requests\CompanySeries\Company;

use App\Enums\RouteNames\Company\CompanyProfile;
use App\Rules\Company\CompanyBelongsToBranchRule;
use App\Rules\Company\CompanyBelongsToUserRule;
use App\Rules\Location\CheckDistrictByProvinceRule;
use App\Rules\Location\CheckWardByDistrictRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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

        $commonRules = $this->getCommonRules();

        return match ($routeName) {
            CompanyProfile::PREFIX->value . CompanyProfile::UPDATE_PROFILE_COMPANY->value => [
                ...$commonRules,
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id',
                    new CompanyBelongsToUserRule($this->input('user_id'))
                ],
            ],

            CompanyProfile::PREFIX->value . CompanyProfile::UPDATE_BRANCH_COMPANY->value => [
                ...$this->getLocationRules(),
                'company_branch_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:company_branches,id'
                ],
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id',
                    new CompanyBelongsToBranchRule($this->input('company_branch_id'))
                ],
            ],

            default => []
        };
    }

    /**
     * @return array[]
     */
    private function getCommonRules(): array
    {
        return [
            'company_name' => ['bail', 'required', 'string', 'max:255'],
            'company_scale_id' => ['bail', 'required', 'integer', 'exists:company_scales,id'],
            'gender_id' => ['bail', 'required', 'integer', 'exists:default_genders,id'],
            'company_working_day_id' => ['bail', 'nullable', 'integer', 'exists:company_working_days,id'],
            'website' => ['bail', 'nullable', 'string', 'max:512'],
            'description' => ['bail', 'nullable', 'string', 'max:512'],
            'tax_code' => ['bail', 'required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    private function getLocationRules(): array
    {
        return [
            'branch_name' => ['bail', 'required', 'string', 'max:255'],
            'province_id' => [
                'bail', 'required', 'integer', 'exists:provinces,id'
            ],
            'district_id' => [
                'bail', 'required', 'integer', 'exists:districts,id',
                new CheckDistrictByProvinceRule($this->input('province_id'))
            ],
            'ward_id' => [
                'bail', 'nullable', 'integer', 'exists:wards,id',
                new CheckWardByDistrictRule($this->input('district_id'))
            ],
            'address' => ['bail', 'nullable', 'string', 'max:512']
        ];
    }
}
