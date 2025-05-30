<?php

namespace App\Http\Requests\CompanySeries\CompanyBranch;

use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Rules\Company\CompanyBelongsToBranchRule;
use App\Rules\Location\CheckDistrictByProvinceRule;
use App\Rules\Location\CheckWardByDistrictRule;
use App\Traits\ValidationResponse\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyBranchRequest extends FormRequest
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
            CompanyBranchEnum::PREFIX->value . CompanyBranchEnum::UPDATE_COMPANY_BRANCH->value => [
                ...$this->getCommonRules(),
                ...$this->getCommonRulesId()
            ],
            CompanyBranchEnum::PREFIX->value . CompanyBranchEnum::STORE_COMPANY_BRANCH->value => [
                ...$this->getCommonRules(),
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id'
                ],
            ],
            CompanyBranchEnum::PREFIX->value . CompanyBranchEnum::DESTROY_COMPANY_BRANCH->value => [
                ...$this->getCommonRulesId()
            ],
            CompanyBranchEnum::PREFIX->value . CompanyBranchEnum::LIST_COMPANY_BRANCH->value => [
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id'
                ]
            ],
            default => []
        };
    }

    /**
     * @return array
     */
    private function getCommonRules(): array
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

    /**
     * @return array
     */
    private function getCommonRulesId(): array
    {
        return [
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
            ]
        ];
    }
}
