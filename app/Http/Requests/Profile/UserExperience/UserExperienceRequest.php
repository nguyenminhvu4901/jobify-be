<?php

namespace App\Http\Requests\Profile\UserExperience;

use App\Enums\RouteNames\Profile\UserExperience;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceRequest extends FormRequest
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
            UserExperience::PREFIX->value . UserExperience::STORE->value => $commonRules,
            UserExperience::PREFIX->value . UserExperience::UPDATE->value => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_experience_id' => ['bail', 'required', 'integer', 'exists:user_experiences,id'],
                'attachments.*.user_experience_resource_id' => [
                        'bail', 'nullable', 'integer', 'exists:user_experience_resources,id',
                    new UniqueArrayValues('attachments.*.user_experience_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_experience_id'),
                        'user_experiences',
                        'user_experience_resources',
                        'user_experience_id',
                        'id'
                    )
                ]
            ],
            UserExperience::PREFIX->value . UserExperience::DESTROY->value => [
                    'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                    'user_experience_id' => ['bail', 'required', 'integer', 'exists:user_experiences,id']
            ],
            UserExperience::PREFIX->value  . UserExperience::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserExperience::PREFIX->value . UserExperience::DETAIL_LIST_USER_EXPERIENCE->value => [
                'user_experience_id' => ['bail', 'required', 'integer', 'exists:user_experiences,id']
            ],
            default => [],
        };
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['start_date', 'end_date']);
    }

    public function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'position' => ['bail', 'required', 'string', 'max:255'],
            'is_working' => ['bail', 'required', 'boolean'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],

            'attachments' => ['bail', 'nullable', 'array', 'max:10'],
            'attachments.*.title' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.description' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id']
        ];
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator): void
    {
        $this->processWithValidator($validator, UserExperience::PREFIX->value . UserExperience::STORE->value);
    }
}
