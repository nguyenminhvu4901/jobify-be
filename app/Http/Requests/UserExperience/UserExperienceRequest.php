<?php

namespace App\Http\Requests\UserExperience;

use App\Enums\DefaultContentType;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceRequest extends FormRequest
{
    use FailedValidation;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        $commonRules = $this->getCommonRules();

        switch ($method){
            case 'POST':
                return $commonRules;
            case 'PUT':
            case 'PATCH':
                $updateRule = [
                    'user_slug' => ['required', 'string', 'exists:users,slug'],
                    'user_experience_id' => ['required', 'integer', 'exists:user_experiences,id'],
                ];

                return array_merge($commonRules, $updateRule);
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

            'attachments' => ['bail', 'nullable', 'array'],
            'attachments.*.title' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.description' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id']
        ];
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('attachments')) {
                foreach ($this->input('attachments') as $index => $attachment) {
                    $contentTypeId = $attachment['content_type_id'] ?? null;

                    if ($contentTypeId == DefaultContentType::IMAGE->value) {
                        $imageRules = ['required', 'image', 'mimes:jpeg,jpg,png,gif,bmp,svg,webp', 'max:10240'];
                        $imageValidator = validator(['image' => $attachment['image'] ?? null], ['image' => $imageRules]);

                        if ($imageValidator->fails()) {
                            foreach ($imageValidator->errors()->get('image') as $message) {
                                $validator->errors()->add("attachments.{$index}.image", $message);
                            }
                        }
                    }

                    if ($contentTypeId == DefaultContentType::FILE->value) {
                        $imageRules = ['required', 'file', 'max:10240'];
                        $imageValidator = validator(['file' => $attachment['file'] ?? null], ['file' => $imageRules]);

                        if ($imageValidator->fails()) {
                            foreach ($imageValidator->errors()->get('file') as $message) {
                                $validator->errors()->add("attachments.{$index}.file", $message);
                            }
                        }
                    }

                    if ($contentTypeId == DefaultContentType::URL->value) {
                        $imageRules = ['required', 'string'];
                        $imageValidator = validator(['url' => $attachment['url'] ?? null], ['url' => $imageRules]);

                        if ($imageValidator->fails()) {
                            foreach ($imageValidator->errors()->get('url') as $message) {
                                $validator->errors()->add("attachments.{$index}.url", $message);
                            }
                        }
                    }


                    if ($contentTypeId == DefaultContentType::VIDEO->value) {
                        $videoRules = ['required', 'file', 'mimes:mp4,mov,avi,flv,mkv', 'max:102400'];
                        $videoValidator = validator(['video' => $attachment['video'] ?? null], ['video' => $videoRules]);

                        if ($videoValidator->fails()) {
                            foreach ($videoValidator->errors()->get('video') as $message) {
                                $validator->errors()->add("attachments.{$index}.video", $message);
                            }
                        }
                    }
                }
            }
        });
    }
}
