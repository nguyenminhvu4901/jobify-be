<?php

namespace App\Http\Requests\CompanySeries\Company;

use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Rules\Company\CompanyBelongsToUserRule;
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
            CompanyProfileEnum::PREFIX->value . CompanyProfileEnum::UPDATE_COMPANY_PROFILE->value => [
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

            'operation_types' => ['bail', 'nullable', 'array'],
            'operation_types.*' => ['bail', 'nullable', 'integer', 'exists:operation_types,id'],

            'business_sectors' => ['bail', 'nullable', 'array'],
            'business_sectors.*' => ['bail', 'nullable', 'integer', 'exists:business_sectors,id'],
        ];
    }
}
