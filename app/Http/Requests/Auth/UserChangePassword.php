<?php

namespace App\Http\Requests\Auth;

use App\Rules\PasswordRule;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserChangePassword extends FormRequest
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
            'slug' => ['required', 'string', 'exists:users,slug'],
            'email' => [
                'required', 'string', 'email',
                Rule::unique('users', 'email')
                    ->ignore($this->input('slug'), 'slug')
                    ->whereNull('deleted_at')
            ],
            'current_password' => [
                'required', 'string', new PasswordRule()
            ],
            'new_password' => [
                'required', 'string', 'different:current_password', new PasswordRule()
            ],
            'new_password_confirmation' => ['required', 'same:new_password', new PasswordRule()],
        ];
    }
}
