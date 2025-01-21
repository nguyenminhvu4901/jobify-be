<?php

namespace App\Http\Requests\Profile;

use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['bail', 'nullable']
        ];
    }

    protected function withValidator($validator): void
    {
        $validator->sometimes('avatar', ['image', 'mimes:jpeg,jpg,png,gif,bmp,svg,webp', 'max:5000'], function ($input) {
            return request()->hasFile('avatar');
        });

        $validator->sometimes('avatar', ['string'], function ($input) {
            return !request()->hasFile('avatar');
        });
    }
}
