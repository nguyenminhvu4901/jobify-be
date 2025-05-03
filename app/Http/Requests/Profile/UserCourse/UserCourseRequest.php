<?php

namespace App\Http\Requests\Profile\UserCourse;

use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCourseRequest extends FormRequest
{
    use FailedValidation;
    use NormalizeDateTrait;
    use ValidatesAttachmentsTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['start_date', 'end_date']);
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
            UserCourseEnum::PREFIX->value.UserCourseEnum::DETAIL_LIST_USER_COURSE->value => [
                'user_course_id' => ['bail', 'required', 'integer', 'exists:user_courses,id'],
            ],
            UserCourseEnum::PREFIX->value.UserCourseEnum::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserCourseEnum::PREFIX->value.UserCourseEnum::STORE->value => $commonRules,
            UserCourseEnum::PREFIX->value.UserCourseEnum::UPDATE->value => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_course_id' => ['bail', 'required', 'integer', 'exists:user_courses,id'],
                'attachments.*.user_course_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_course_resources,id',
                    new UniqueArrayValues('attachments.*.user_course_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_course_id'),
                        'user_courses',
                        'user_course_resources',
                        'user_course_id',
                        'id'
                    ),
                ],
            ],
            UserCourseEnum::PREFIX->value.UserCourseEnum::DESTROY->value => [
                'user_course_id' => ['bail', 'required', 'integer', 'exists:user_courses,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            default => []
        };
    }

    /**
     * @return array[]
     */
    public function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'organization' => ['bail', 'nullable', 'string', 'max:255'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'description' => ['bail', 'nullable', 'string'],

            'attachments' => ['bail', 'nullable', 'array', 'max:10'],
            'attachments.*.title' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.description' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id'],
        ];
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator): void
    {
        $this->processWithValidator($validator, UserCourseEnum::PREFIX->value.UserCourseEnum::STORE->value);
    }
}
