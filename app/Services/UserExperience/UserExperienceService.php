<?php

namespace App\Services\UserExperience;

use App\DataTransferObjects\UserExperienceResource\AttachmentDTO;
use App\Enums\DefaultContentType;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceService
{
    public static function handleAttachments(FormRequest $request): array
    {
        return collect($request->get('attachments', []))
            ->map(function ($attachment, $key) use ($request) {
                switch ($attachment['content_type_id']) {
                    case DefaultContentType::IMAGE->value:
                        $content = $request->file("attachments.$key.image");
                        break;
                    case DefaultContentType::URL->value:
                        $content = $request->input("attachments.$key.url");
                        break;
                    case DefaultContentType::VIDEO->value:
                        $content = $request->file("attachments.$key.video");
                        break;
                    default:
                        return null;
                }

                $attachmentDTO = new AttachmentDTO(
                    $attachment['title'],
                    $attachment['description'],
                    $attachment['content_type_id'],
                    $content ?? null,
                    $attachment['user_experience_resource_id'] ?? null
                );

                return [
                    'title' => $attachmentDTO->title,
                    'description' => $attachmentDTO->description,
                    'content_type_id' => $attachmentDTO->contentTypeId,
                    'content' => $attachmentDTO->content,
                    'user_experience_resource_id' => $attachmentDTO->userExperienceResourceId,
                ];
            })
            ->filter()
            ->values()
            ->toArray();
    }
}
