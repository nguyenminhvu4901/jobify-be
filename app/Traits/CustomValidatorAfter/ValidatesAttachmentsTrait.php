<?php

namespace App\Traits\CustomValidatorAfter;

use App\Enums\DefaultContentType;

trait ValidatesAttachmentsTrait
{
    private function validateImage($attachment, $index, $validator): void
    {
        $imageRules = ['bail', 'required', 'image', 'mimes:jpeg,jpg,png,gif,bmp,svg,webp', 'max:10240'];
        $imageValidator = validator(['image' => $attachment['image'] ?? null], ['image' => $imageRules]);

        if ($imageValidator->fails()) {
            foreach ($imageValidator->errors()->get('image') as $message) {
                $validator->errors()->add("attachments.{$index}.image", $message);
            }
        }
    }

    private function validateImagePath($attachment, $index, $validator): void
    {
        $imageRules = ['bail', 'required', 'string'];
        $imageValidator = validator(['image' => $attachment['image'] ?? null], ['image' => $imageRules]);

        if ($imageValidator->fails()) {
            foreach ($imageValidator->errors()->get('image') as $message) {
                $validator->errors()->add("attachments.{$index}.image", $message);
            }
        }
    }

    private function validateUrl($attachment, $index, $validator): void
    {
        $urlRules = ['bail', 'required', 'string'];
        $urlValidator = validator(['url' => $attachment['url'] ?? null], ['url' => $urlRules]);

        if ($urlValidator->fails()) {
            foreach ($urlValidator->errors()->get('url') as $message) {
                $validator->errors()->add("attachments.{$index}.url", $message);
            }
        }
    }

    private function validateVideo($attachment, $index, $validator): void
    {
        $videoRules = ['bail', 'required', 'file', 'mimes:mp4,mov,avi,flv,mkv', 'max:51200'];
        $videoValidator = validator(['video' => $attachment['video'] ?? null], ['video' => $videoRules]);

        if ($videoValidator->fails()) {
            foreach ($videoValidator->errors()->get('video') as $message) {
                $validator->errors()->add("attachments.{$index}.video", $message);
            }
        }
    }

    private function validateVideoPath($attachment, $index, $validator): void
    {
        $videoRules = ['bail', 'required', 'string'];
        $videoValidator = validator(['video' => $attachment['video'] ?? null], ['video' => $videoRules]);

        if ($videoValidator->fails()) {
            foreach ($videoValidator->errors()->get('video') as $message) {
                $validator->errors()->add("attachments.{$index}.video", $message);
            }
        }
    }

    private function validateImageUpdate($attachment, $index, $validator): void
    {
        if (! empty($attachment['image']) && is_string($attachment['image'])) {
            $this->validateImagePath($attachment, $index, $validator);
        } else {
            $this->validateImage($attachment, $index, $validator);
        }
    }

    private function validateVideoUpdate($attachment, $index, $validator): void
    {
        if (! empty($attachment['video']) && is_string($attachment['video'])) {
            $this->validateVideoPath($attachment, $index, $validator);
        } else {
            $this->validateVideo($attachment, $index, $validator);
        }
    }

    protected function processWithValidator($validator, string $routeNameCondition): void
    {
        $routeName = request()->route()->getName();

        $validator->after(function ($validator) use ($routeName, $routeNameCondition) {

            if ($this->has('attachments')) {
                $attachments = $this->attachments;

                foreach ($attachments as $index => $attachment) {
                    $contentTypeId = $attachment['content_type_id'] ?? null;

                    switch ($contentTypeId) {
                        case DefaultContentType::IMAGE->value:
                            if ($routeName == $routeNameCondition) {
                                $this->validateImage($attachment, $index, $validator);
                            } else {
                                $this->validateImageUpdate($attachment, $index, $validator);
                            }
                            break;

                        case DefaultContentType::URL->value:
                            $this->validateUrl($attachment, $index, $validator);
                            break;

                        case DefaultContentType::VIDEO->value:
                            if ($routeName == $routeNameCondition) {
                                $this->validateVideo($attachment, $index, $validator);
                            } else {
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
