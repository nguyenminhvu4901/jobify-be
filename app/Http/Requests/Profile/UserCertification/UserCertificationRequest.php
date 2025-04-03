<?php

namespace App\Http\Requests\Profile\UserCertification;

use App\Enums\RouteNames\Profile\UserCertification;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCertificationRequest extends FormRequest
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
            UserCertification::PREFIX->value . UserCertification::STORE->value => $commonRules,
            UserCertification::PREFIX->value . UserCertification::UPDATE->value => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_certification_id' => ['bail', 'required', 'integer', 'exists:user_certifications,id'],
                'attachments.*.user_certification_resource_id' => [
                        'bail', 'nullable', 'integer', 'exists:user_certification_resources,id',
                    new UniqueArrayValues('attachments.*.user_certification_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_certification_id'),
                        'user_certifications',
                        'user_certification_resources',
                        'user_certification_id',
                        'id'
                    )
                ]
            ],
            UserCertification::PREFIX->value . UserCertification::DETAIL_LIST_USER_CERTIFICATION->value => [
                'user_certification_id' => ['bail', 'required', 'integer', 'exists:user_certifications,id']
            ],
            UserCertification::PREFIX->value . UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value  => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserCertification::PREFIX->value .UserCertification::DESTROY->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_certification_id' => ['bail', 'required', 'integer', 'exists:user_certifications,id']
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

    /**
     * @return array[]
     */
    public function getCommonRules() :array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'organization' => ['bail', 'nullable', 'string', 'max:255'],
            'is_no_expiration' => ['bail', 'required', 'boolean'],
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
        $this->processWithValidator($validator, UserCertification::PREFIX->value . UserCertification::STORE->value);
    }
}
