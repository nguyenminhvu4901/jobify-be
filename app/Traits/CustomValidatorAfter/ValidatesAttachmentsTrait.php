<?php

namespace App\Traits\CustomValidatorAfter;

use App\Enums\DefaultContentType;

trait ValidatesAttachmentsTrait
{
    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
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

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
    private function validateImagePath($attachment, $index, $validator): void
    {
        $imageRules = ['required', 'string'];
        $imageValidator = validator(['image' => $attachment['image'] ?? null], ['image' => $imageRules]);

        if ($imageValidator->fails()) {
            foreach ($imageValidator->errors()->get('image') as $message) {
                $validator->errors()->add("attachments.{$index}.image", $message);
            }
        }
    }

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
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

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
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

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
    private function validateVideoPath($attachment, $index, $validator): void
    {
        $videoRules = ['required', 'string'];
        $videoValidator = validator(['video' => $attachment['video'] ?? null], ['video' => $videoRules]);

        if ($videoValidator->fails()) {
            foreach ($videoValidator->errors()->get('video') as $message) {
                $validator->errors()->add("attachments.{$index}.video", $message);
            }
        }
    }

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
    private function validateImageUpdate($attachment, $index, $validator): void
    {
        if(is_string($attachment['image'])){
            $this->validateImagePath($attachment, $index, $validator);
        }else{
            $this->validateImage($attachment, $index, $validator);
        }
    }

    /**
     * @param $attachment
     * @param $index
     * @param $validator
     * @return void
     */
    private function validateVideoUpdate($attachment, $index, $validator): void
    {
        if(is_string($attachment['video'])){
            $this->validateVideoPath($attachment, $index, $validator);
        }else{
            $this->validateVideo($attachment, $index, $validator);
        }
    }
}
