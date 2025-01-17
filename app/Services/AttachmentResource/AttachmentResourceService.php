<?php

namespace App\Services\AttachmentResource;

use App\DataTransferObjects\UserExperienceResource\AttachmentDTO;
use App\Enums\DefaultContentType;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Foundation\Http\FormRequest;

class AttachmentResourceService
{
    use ImageHandler, VideoHandler;

    /**
     * @param FormRequest $request
     * @param string $idName
     * @return array
     */
    public static function handleAttachments(FormRequest $request, string $idName): array
    {
        return collect($request->get('attachments', []))
            ->map(function ($attachment, $key) use ($request, $idName) {
                switch ($attachment['content_type_id']) {
                    case DefaultContentType::IMAGE->value:
                        if(!empty($attachment['image']) && is_string($attachment['image'])){
                            $content = $request->input("attachments.$key.image");
                        }else{
                            $content = $request->file("attachments.$key.image");
                        }

                        break;
                    case DefaultContentType::URL->value:
                        $content = $request->input("attachments.$key.url");

                        break;
                    case DefaultContentType::VIDEO->value:
                        if(!empty($attachment['video']) && is_string($attachment['video'])){
                            $content = $request->input("attachments.$key.video");
                        }else{
                            $content = $request->file("attachments.$key.video");
                        }

                        break;
                    default:
                        return null;
                }

                $attachmentDTO = new AttachmentDTO(
                    $attachment['title'],
                    $attachment['description'],
                    $attachment['content_type_id'],
                    $content ?? null,
                    $attachment[$idName] ?? null
                );

                return [
                    'title' => $attachmentDTO->title,
                    'description' => $attachmentDTO->description,
                    'content_type_id' => $attachmentDTO->contentTypeId,
                    'content' => $attachmentDTO->content,
                    $idName => $attachmentDTO->userResourceId,
                ];
            })
            ->filter()
            ->values()
            ->toArray();
    }

    /**
     * @param $attachmentResource
     * @return void
     */
    public function deleteFileAttachment($attachmentResource): void
    {
        if ($attachmentResource->content_type_id == DefaultContentType::IMAGE->value) {
            $this->deleteImage($attachmentResource->path);
        }elseif ($attachmentResource->content_type_id == DefaultContentType::VIDEO->value) {
            $this->deleteVideo($attachmentResource->path);
        }
    }

    /**
     * @param $attachments
     * @param $userModelResource
     * @param $idName
     * @return array
     */
    public function getListRedundantIdsToDelete($attachments, $userModelResource, $idName): array
    {
        $attachmentIds = getFilterCollectionIds($attachments, $idName);
        $userModelResourceIds = getFilterCollectionIds($userModelResource);

        return getElementsNotInFirstCollection($attachmentIds, $userModelResourceIds)->toArray();
    }
}
