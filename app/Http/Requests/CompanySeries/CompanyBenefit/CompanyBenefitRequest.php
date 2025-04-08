<?php

namespace App\Http\Requests\CompanySeries\CompanyBenefit;

use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Rules\Company\CompanyBelongsToBenefitRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyBenefitRequest extends FormRequest
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

        return match ($routeName){
            CompanyBenefitEnum::PREFIX->value . CompanyBenefitEnum::LIST_COMPANY_BENEFIT->value => [
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id'
                ]
            ],
            CompanyBenefitEnum::PREFIX->value . CompanyBenefitEnum::STORE_COMPANY_BENEFIT->value => [
                ...$this->getCommonRules(),
                'benefit_name' => [
                    'bail', 'required', 'string', 'max:255', 'unique:company_benefits,benefit_name'
                ],
            ],
            CompanyBenefitEnum::PREFIX->value . CompanyBenefitEnum::UPDATE_COMPANY_BENEFIT->value => [
                ...$this->getCommonRules(),
                ...$this->getCommonRulesId(),
                'benefit_name' => [
                    'bail', 'required', 'string', 'max:255',
                    Rule::unique('company_benefits', 'benefit_name')->ignore(
                        $this->input('company_benefit_id')
                    ),
                ],
            ],
            CompanyBenefitEnum::PREFIX->value . CompanyBenefitEnum::DESTROY_COMPANY_BENEFIT->value => [
                ...$this->getCommonRulesId(),
            ],
            default => []
        };
    }

    public function getCommonRules(): array
    {
        return [
            'benefit_description' => ['bail', 'required', 'string', 'max:512']
        ];
    }

    /**
     * @return array
     */
    private function getCommonRulesId(): array
    {
        return [
            'company_benefit_id' => [
                'bail',
                'required',
                'integer',
                'exists:company_benefits,id'
            ],
            'company_id' => [
                'bail',
                'required',
                'integer',
                'exists:companies,id',
                new CompanyBelongsToBenefitRule($this->input('company_benefit_id'))
            ]
        ];
    }
}
