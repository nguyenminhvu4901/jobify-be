<?php

namespace App\Http\Requests\Profile;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileAvatarRequest extends FormRequest
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
            'avatar' => ['bail', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif']
        ];
    }
}
