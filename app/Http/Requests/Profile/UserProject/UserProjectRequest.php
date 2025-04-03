<?php

namespace App\Http\Requests\Profile\UserProject;

use App\Enums\RouteNames\Profile\UserProject;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserProjectRequest extends FormRequest
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
            UserProject::PREFIX->value . UserProject::DETAIL_LIST_USER_PROJECT->value => [
                'user_project_id' => ['bail', 'required', 'integer', 'exists:user_projects,id']
            ],
            UserProject::PREFIX->value . UserProject::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserProject::PREFIX->value . UserProject::STORE->value => $commonRules,
            UserProject::PREFIX->value . UserProject::UPDATE->value => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_project_id' => ['bail', 'required', 'integer', 'exists:user_projects,id'],
                'attachments.*.user_project_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_project_resources,id',
                    new UniqueArrayValues('attachments.*.user_project_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_project_id'),
                        'user_projects',
                        'user_project_resources',
                        'user_project_id',
                        'id'
                    )
                ]
            ],
            UserProject::PREFIX->value . UserProject::DESTROY->value => [
                'user_project_id' => ['bail', 'required', 'integer', 'exists:user_projects,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            default => []
        };
    }

    public function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'client' => ['bail', 'required', 'string', 'max:255'],
            'member' => ['bail', 'required', 'integer', 'gte:0'],
            'position' => ['bail', 'required', 'string', 'max:512'],
            'mission' => ['bail', 'required', 'string', 'max:512'],
            'technology' => ['bail', 'nullable', 'string', 'max:512'],
            'is_working' => ['bail', 'required', 'boolean'],
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
        $this->processWithValidator($validator, UserProject::PREFIX->value . UserProject::STORE->value);
    }
}
