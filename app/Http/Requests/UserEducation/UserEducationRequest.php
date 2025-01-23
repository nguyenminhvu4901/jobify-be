<?php

namespace App\Http\Requests\UserEducation;

use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserEducationRequest extends FormRequest
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

        $commonRule = $this->defineCommonRule();

        return match ($routeName){
            "profile.userEducation.store" => $commonRule,
            default => []
        };

    }

    /**
     * @return array[]
     */
    private function defineCommonRule(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:512'],
            'major' => ['bail', 'required', 'string', 'max:512'],
            'is_studying' => ['bail', 'required', 'boolean'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'description' => ['bail', 'nullable', 'string']
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['start_date', 'end_date']);
    }
}
