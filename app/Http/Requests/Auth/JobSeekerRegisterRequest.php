<?php

namespace App\Http\Requests\Auth;

use App\Rules\PasswordRule;
use App\Rules\PhoneNumberRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobSeekerRegisterRequest extends FormRequest
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
            'full_name' => ['bail', 'required', 'string', 'max:255'],
            'email' => [
                'bail', 'required', 'string', 'email',
                Rule::unique('users', 'email')->whereNull('deleted_at')
            ],
            'password' => [
                'bail', 'required', 'string', new PasswordRule(),
            ],
            'password_confirmation' => ['bail', 'required', 'same:password'],
            'phone_number' => ['bail', 'required', 'string', new PhoneNumberRule()],
        ];
    }
}
