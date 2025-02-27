<?php

namespace App\Http\Requests\UserActivity;

use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserActivityRequest extends FormRequest
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
            "profile.userActivity.store" => $commonRules,
            "profile.userActivity.updateUserActivity" => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_activity_id' => ['bail', 'required', 'integer', 'exists:user_activities,id'],
                'attachments.*.user_activity_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_activity_resources,id',
                    new UniqueArrayValues('attachments.*.user_activity_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_activity_id'),
                        'user_activities',
                        'user_activity_resources',
                        'user_activity_id',
                        'id'
                    )
                ]
            ],
            "profile.userActivity.detailListOfUserActivity" => [
                'user_activity_id' => ['bail', 'required', 'integer', 'exists:user_activities,id']
            ],
            "profile.userActivity.detailListOfUserActivityByUserSlug" => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            "profile.userActivity.destroy" => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_activity_id' => ['bail', 'required', 'integer', 'exists:user_activities,id'],
            ],
            default => [],
        };
    }

    /**
     * @return array[]
     */
    public function getCommonRules() :array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'position' => ['bail', 'required', 'string', 'max:255'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'description' => ['bail', 'nullable', 'string'],

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
        $this->processWithValidator($validator, "profile.userCertification.store");
    }
}
