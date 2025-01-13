<?php

namespace App\Http\Requests\UserExperience;

use App\Enums\DefaultContentType;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceRequest extends FormRequest
{
    use FailedValidation, ValidatesAttachmentsTrait;
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

        switch ($routeName){
            case "profile.userExperience.store":

                return $commonRules;

            case "profile.userExperience.updateExperience":
                $updateRule = [
                    'user_slug' => ['required', 'string', 'exists:users,slug'],
                    'user_experience_id' => ['required', 'integer', 'exists:user_experiences,id'],
                    'attachments.*.user_experience_resource_id' => [
                        'bail', 'nullable', 'integer', 'exists:user_experience_resources,id'
                    ]
                ];

                return array_merge($commonRules, $updateRule);

            case "profile.userExperience.destroy":
                return [
                    'user_slug' => ['required', 'string', 'exists:users,slug'],
                    'user_experience_id' => ['required', 'integer', 'exists:user_experiences,id']
                ];

            case "profile.userExperience.DetailListOfUserExperience":
                return [
                    'user_experience_id' => ['required', 'integer', 'exists:user_experiences,id']
                ];
            default:
                return [];
        }
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
}
