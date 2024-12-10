<?php

namespace App\Http\Requests\Auth;

use App\Rules\PasswordRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecruiterRegisterRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email',
                Rule::unique('users', 'email')->whereNull('deleted_at')
            ],
            'password' => [
                'required', 'string', 'min:6', 'max:25',
                new PasswordRule(),
            ],
            'password_confirmation' => ['required', 'same:password'],
            'gender' => ['required', 'integer', 'exists:default_genders,id'],
            'phone_number' => ['required'],
            'company_name' => ['required'],
            'province' => ['required', 'exists:provinces,id'],
            'district' => ['required', 'exists:districts,id']
        ];
    }
}
