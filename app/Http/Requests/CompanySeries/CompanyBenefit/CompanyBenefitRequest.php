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
            default => []
        };
    }

    public function getCommonRules()
    {
        return [

        ];
    }

    public function getCommonRulesId()
    {
        return [

        ];
    }
}
