<?php

namespace App\Http\Requests\CompanySeries\CompanyBenefit;

use App\Enums\RouteNames\Company\CompanyBenefit;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            CompanyBenefit::PREFIX->value . CompanyBenefit::LIST_COMPANY_BENEFIT->value => [
                'company_id' => [
                    'bail',
                    'required',
                    'integer',
                    'exists:companies,id'
                ]
            ],
            CompanyBenefit::PREFIX->value . CompanyBenefit::STORE_COMPANY_BENEFIT->value => [
                ...$this->getCommonRules()
            ],
            default => []
        };
    }

    public function getCommonRules(): array
    {
        return [
            'benefit_name' => ['bail', 'required', 'string', 'max:255', 'unique:company_benefits,benefit_name'],
            'benefit_description' => ['bail', 'required', 'string', 'max:512']
        ];
    }

    public function getCommonRulesId()
    {
        return [

        ];
    }
}
