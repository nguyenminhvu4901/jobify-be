<?php

namespace App\Http\Requests\UserExperience;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        $commonRules = $this->getCommonRules();

        switch ($method){
            case 'POST':
                return $commonRules;
            case 'PUT':
            case 'PATCH':
                $updateRule = [
                    'user_slug' => ['required', 'string', 'exists:users,slug'],
                    'user_experience_id' => ['required', 'integer', 'exists:user_experiences,id']
                ];

                return array_merge($commonRules, $updateRule);
            default:
                return [];
        }
    }

    public function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'position' => ['bail', 'required', 'string', 'max:255'],
            'is_working' => ['bail', 'required', 'boolean'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
        ];
    }
}
