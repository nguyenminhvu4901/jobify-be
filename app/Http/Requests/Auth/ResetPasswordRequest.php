<?php

namespace App\Http\Requests\Auth;

use App\Rules\PasswordRule;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
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
        return [
            'token' => ['required'],
            'email' => [
                'bail', 'required', 'string', 'email',
                Rule::exists('users', 'email')->whereNull('deleted_at')
            ],
            'password' => [
                'bail', 'required', 'string', new PasswordRule(),
            ],
            'password_confirmation' => ['bail', 'required', 'same:password'],
        ];
    }
}
