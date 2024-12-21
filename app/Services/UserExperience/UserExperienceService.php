<?php

namespace App\Services\UserExperience;

use App\DataTransferObjects\UserExperienceResource\AttachmentDTO;
use App\Enums\DefaultContentType;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Foundation\Http\FormRequest;

class UserExperienceService
{
    use ImageHandler, VideoHandler;

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

    public function processStoreAttachment($attachment)
    {
        $user = auth()->user();

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value) {
            $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/experiences';
            $pathStorage = $this->storeImage($attachment['content'], $path, $user);

        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $pathStorage = $attachment['content'];

        } elseif ($attachment['content_type_id'] == DefaultContentType::VIDEO->value) {
            $path = 'videos/profiles/' . extractEmailPrefix($user->email) . '/experiences';
            $pathStorage = $this->storeVideo($attachment['content'], $path, $user);

        } else {
            return null;
        }

        return $pathStorage;
    }

    public function processUpdateAttachment()
    {

    }
}
