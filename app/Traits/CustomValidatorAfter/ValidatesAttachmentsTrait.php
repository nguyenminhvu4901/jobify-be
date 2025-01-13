<?php

namespace App\Traits\CustomValidatorAfter;

use App\Enums\DefaultContentType;

trait ValidatesAttachmentsTrait
{
    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($this->has('attachments')) {
                $attachments = $this->attachments;

                foreach ($attachments as $index => $attachment) {
                    $contentTypeId = $attachment['content_type_id'] ?? null;

                    switch ($contentTypeId){
                        case DefaultContentType::IMAGE->value:
                            $this->validateImage($attachment, $index, $validator);
                            break;

                        case DefaultContentType::URL->value:
                            $this->validateUrl($attachment, $index, $validator);
                            break;

                        case DefaultContentType::VIDEO->value:
                            $this->validateVideo($attachment, $index, $validator);
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

    private function validateImage($attachment, $index, $validator): void
    {
        $imageRules = ['required', 'image', 'mimes:jpeg,jpg,png,gif,bmp,svg,webp', 'max:10240'];
        $imageValidator = validator(['image' => $attachment['image'] ?? null], ['image' => $imageRules]);

        if ($imageValidator->fails()) {
            foreach ($imageValidator->errors()->get('image') as $message) {
                $validator->errors()->add("attachments.{$index}.image", $message);
            }
        }
    }

    private function validateUrl($attachment, $index, $validator): void
    {
        $urlRules = ['required', 'string'];
        $urlValidator = validator(['url' => $attachment['url'] ?? null], ['url' => $urlRules]);

        if ($urlValidator->fails()) {
            foreach ($urlValidator->errors()->get('url') as $message) {
                $validator->errors()->add("attachments.{$index}.url", $message);
            }
        }
    }

    private function validateVideo($attachment, $index, $validator): void
    {
        $videoRules = ['required', 'file', 'mimes:mp4,mov,avi,flv,mkv', 'max:51200'];
        $videoValidator = validator(['video' => $attachment['video'] ?? null], ['video' => $videoRules]);

        if ($videoValidator->fails()) {
            foreach ($videoValidator->errors()->get('video') as $message) {
                $validator->errors()->add("attachments.{$index}.video", $message);
            }
        }
    }
}
