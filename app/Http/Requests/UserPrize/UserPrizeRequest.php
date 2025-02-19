<?php

namespace App\Http\Requests\UserPrize;

use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserPrizeRequest extends FormRequest
{
    use FailedValidation, ValidatesAttachmentsTrait, NormalizeDateTrait;
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
        $routeName = request()->route()->getName();

        $commonRules = $this->getCommonRules();

        return match ($routeName) {
            "profile.userPrize.detailListOfUserPrize" => [
                'user_prize_id' => ['bail', 'required', 'integer', 'exists:user_prizes,id']
            ],
            "profile.userPrize.detailListOfUserPrizeByUserSlug" => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            "profile.userPrize.store" => $commonRules,
            "profile.userPrize.updatePrize" => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_prize_id' => ['bail', 'required', 'integer', 'exists:user_prizes,id'],
                'attachments.*.user_prize_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_prize_resources,id'
                ]
            ],
            "profile.userPrize.destroy" => [
                'user_prize_id' => ['bail', 'required', 'integer', 'exists:user_prizes,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
        };
    }

    public function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'organization' => ['bail', 'required', 'string', 'max:255'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],

            'attachments' => ['bail', 'nullable', 'array', 'max:10'],
            'attachments.*.title' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.description' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id']
        ];
    }


    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['start_date', 'end_date']);
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator): void
    {
        $this->processWithValidator($validator, "profile.userPrize.store");
    }
}
