<?php

namespace App\Http\Requests\UserCertification;

use App\Enums\DefaultContentType;
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
            "profile.userCertification.store" => $commonRules,
            "profile.userCertification.updateUserCertification" => array_merge(
                $commonRules,
                [
                    'user_slug' => ['required', 'string', 'exists:users,slug'],
                    'user_certification_id' => ['required', 'integer', 'exists:user_certifications,id'],
                    'attachments.*.user_certification_resource_id' => [
                        'bail', 'nullable', 'integer', 'exists:user_certification_resources,id'
                    ]
                ]
            ),
            "profile.userCertification.DetailListOfUserCertification" => [
                'user_certification_id' => ['required', 'integer', 'exists:user_certifications,id']
            ],
            "profile.userCertification.DetailListOfUserCertificationByUserSlug" => [
                'user_slug' => ['required', 'string', 'exists:users,slug'],
            ],
            "profile.userCertification.destroy" => [
                'user_slug' => ['required', 'string', 'exists:users,slug'],
                'user_certification_id' => ['required', 'integer', 'exists:user_certifications,id']
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
        $routeName = request()->route()->getName();

        $validator->after(function ($validator) use ($routeName) {

            if ($this->has('attachments')) {
                $attachments = $this->attachments;

                foreach ($attachments as $index => $attachment) {
                    $contentTypeId = $attachment['content_type_id'] ?? null;

                    switch ($contentTypeId){
                        case DefaultContentType::IMAGE->value:
                            if($routeName == "profile.userCertification.store")
                            {
                                $this->validateImage($attachment, $index, $validator);
                            }else{
                                $this->validateImageUpdate($attachment, $index, $validator);
                            }
                            break;

                        case DefaultContentType::URL->value:
                            $this->validateUrl($attachment, $index, $validator);
                            break;

                        case DefaultContentType::VIDEO->value:
                            if($routeName == "profile.userCertification.store")
                            {
                                $this->validateVideo($attachment, $index, $validator);
                            }else{
                                $this->validateVideoUpdate($attachment, $index, $validator);
                            }
                            break;

                        default:
                            $validator->errors()->add(
                                "attachments.{$index}.content_type_id",
                                __('validation.custom.invalid_content_type_value_please_choose_again')
                            );
                            break;
                    }
                }
            }
        });
    }
}
