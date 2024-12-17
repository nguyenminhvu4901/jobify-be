<?php

namespace App\Http\Requests\Profile;

use App\Rules\PhoneNumberRule;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
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
            'full_name' => ['bail', 'required', 'string', 'max:255'],
            'phone_number' => ['bail', 'required', 'string', new PhoneNumberRule()],
            'position' => ['bail', 'required', 'string', 'max:255'],
            'gender_id' => ['bail', 'required', 'integer', 'exists:default_genders,id'],
            'birth_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'description' => ['bail', 'nullable', 'string'],
        ];
    }
}
