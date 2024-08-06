<?php

namespace App\Http\Requests\AuthRequest\API;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ValidationTrait;
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
            'username' => ['bail', 'required', 'string'],
            'password' => ['bail', 'required']
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => __('validation.required', ['name' => 'username']),
            'password.required' => __('validation.required', ['name' => 'password']),
        ];
    }
}
