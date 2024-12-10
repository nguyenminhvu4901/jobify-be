<?php

namespace App\Http\Requests\Auth;

use App\Rules\PasswordRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => ['bail', 'required', 'string'],
            'password' => ['bail', 'required', new PasswordRule()]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => __('validation.required', ['name' => 'email']),
            'password.required' => __('validation.required', ['name' => 'password']),
        ];
    }
}
