<?php

namespace App\Http\Requests\Profile\UserEducation;

use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserEducationRequest extends FormRequest
{
    use FailedValidation;
    use NormalizeDateTrait;

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

        $commonRule = $this->defineCommonRule();

        return match ($routeName) {
            UserEducationEnum::PREFIX->value.UserEducationEnum::STORE->value => $commonRule,
            UserEducationEnum::PREFIX->value.UserEducationEnum::DETAIL_LIST_USER_EDUCATION->value => [
                'user_education_id' => ['bail', 'required', 'integer', 'exists:user_educations,id'],
            ],
            UserEducationEnum::PREFIX->value.UserEducationEnum::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserEducationEnum::PREFIX->value.UserEducationEnum::UPDATE->value => [
                ...$commonRule,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_education_id' => ['bail', 'required', 'integer', 'exists:user_educations,id'],
            ],
            UserEducationEnum::PREFIX->value.UserEducationEnum::DESTROY->value => [
                'user_education_id' => ['bail', 'required', 'integer', 'exists:user_educations,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            default => []
        };

    }

    /**
     * @return array[]
     */
    private function defineCommonRule(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:512'],
            'major' => ['bail', 'required', 'string', 'max:512'],
            'is_studying' => ['bail', 'required', 'boolean'],
            'start_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'end_date' => ['bail', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'description' => ['bail', 'nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['start_date', 'end_date']);
    }
}
