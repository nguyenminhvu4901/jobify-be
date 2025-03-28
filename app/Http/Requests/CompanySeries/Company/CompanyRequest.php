<?php

namespace App\Http\Requests\CompanySeries\Company;

use App\Enums\RouteNames\Company\CompanyProfile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
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
//            CompanyProfile::PREFIX->value .
//            CompanyProfile::UPDATE_PROFILE_COMPANY->value =>
//            dd(123),

            default => []
        };
    }
}
