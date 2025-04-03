<?php

namespace App\Http\Requests\Profile\UserCourse;

use App\Enums\RouteNames\Profile\UserCourse;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCourseRequest extends FormRequest
{
    use FailedValidation, ValidatesAttachmentsTrait, NormalizeDateTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return void
     */
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

        return match ($routeName){
            UserCourse::PREFIX->value . UserCourse::DETAIL_LIST_USER_COURSE->value => [
                'user_course_id' => ['bail', 'required', 'integer', 'exists:user_courses,id']
            ],
            UserCourse::PREFIX->value . UserCourse::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserCourse::PREFIX->value . UserCourse::STORE->value => $commonRules,
            UserCourse::PREFIX->value . UserCourse::UPDATE->value => [
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
                    )
                ]
            ],
            UserCourse::PREFIX->value . UserCourse::DESTROY->value => [
                'user_course_id' => ['bail', 'required', 'integer', 'exists:user_courses,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug']
            ],
            default => []
        };
    }

    /**
     * @return array[]
     */
    public function getCommonRules() :array
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
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id']
        ];
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator): void
    {
        $this->processWithValidator($validator, UserCourse::PREFIX->value . UserCourse::STORE->value);
    }
}
