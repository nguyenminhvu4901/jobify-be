<?php

namespace App\Services\UserExperience;

use App\DataTransferObjects\UserExperienceResource\AttachmentDTO;
use App\Enums\DefaultContentType;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class UserExperienceService
{
    use ImageHandler, VideoHandler;

    public function __construct(
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
    )
    {}

    /**
     * @param FormRequest $request
     * @return array
     */
    public static function handleAttachments(FormRequest $request): array
    {
        return collect($request->get('attachments', []))
            ->map(function ($attachment, $key) use ($request) {
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


    /**
     * @param $attachment
     * @param $userExperienceId
     * @param bool $isStore
     * @return void
     */
    public function processAttachment($attachment, $userExperienceId, bool $isStore = true): void
    {
        $pathStorage = $this->processStoreAttachment($attachment);

        if(!empty($pathStorage))
        {
            if($isStore){
                $this->storeUserExperienceResource($attachment, $userExperienceId, $pathStorage);
            }else{
                $this->updateUserExperienceResource($attachment, $userExperienceId, $pathStorage);
            }
        }
    }

    /**
     * @param $attachment
     * @param $userExperienceId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    private function storeUserExperienceResource($attachment, $userExperienceId, $pathStorage): mixed
    {
        return $this->userExperienceResourceRepository->create([
            'user_experience_id' => $userExperienceId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param $attachment
     * @param $userExperienceResourceId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    private function updateUserExperienceResource($attachment, $userExperienceResourceId, $pathStorage): mixed
    {
        return $this->userExperienceResourceRepository->update([
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ], $userExperienceResourceId);
    }

    /**
     * @param $attachment
     * @return mixed|string|null
     */
    public function processStoreAttachment($attachment): mixed
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

    /**
     * @param $attachments
     * @param $userExperienceResource
     * @return void
     */
    public function processUpdateAttachment(
        $attachments, $userExperienceResource, $userExperienceId
    ): void
    {
        $this->processDeleteUserExperienceResource($attachments, $userExperienceResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_experience_resource_id'])){
                $this->updateAttachment($attachment);
            }else{
                $pathStorage = $this->processStoreAttachment($attachment);

                $this->storeUserExperienceResource(
                    $attachment, $userExperienceId, $pathStorage
                );
            }
        }
    }

    /**
     * @param $userExperienceResource
     * @return void
     */
    public function processDeleteAttachment($userExperienceResource): void
    {
        if ($userExperienceResource->content_type_id == DefaultContentType::IMAGE->value) {
            $this->deleteImage($userExperienceResource->path);
        }elseif ($userExperienceResource->content_type_id == DefaultContentType::VIDEO->value) {
            $this->deleteVideo($userExperienceResource->path);
        }
    }

    /**
     * @param $attachments
     * @param $userExperienceResource
     * @return mixed
     */
    private function processDeleteUserExperienceResource($attachments, $userExperienceResource): mixed
    {
        $attachmentIds = getFilterCollectionIds($attachments, 'user_experience_resource_id');
        $userExperienceResourceIds = getFilterCollectionIds($userExperienceResource);

        $listDelIds = getElementsNotInFirstCollection($attachmentIds, $userExperienceResourceIds)->toArray();

        $listUserExperienceResource = $this->userExperienceResourceRepository
            ->getListUserExperienceResourceByIds($listDelIds);

        return $listUserExperienceResource->map(function ($eachUserExperienceResource){
            $this->processDeleteAttachment($eachUserExperienceResource);
            $this->userExperienceResourceRepository->destroy($eachUserExperienceResource);
        });
    }

    /**
     * @param $attachment
     * @return void|null
     */
    private function updateAttachment($attachment)
    {
        $userExperienceResource = $this->userExperienceResourceRepository
            ->find($attachment['user_experience_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
            ) {
            if(is_string($attachment['content'])){
                $this->processDeleteAttachment($userExperienceResource);
                $this->updateUserExperienceResource($attachment, $userExperienceResource->id, $attachment['content']);
            }else{
                $this->processDeleteAttachment($userExperienceResource);
                $this->processAttachment($attachment, $userExperienceResource->id, false);
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $this->updateUserExperienceResource($attachment, $userExperienceResource->id, $attachment['content']);
        }else {
            return null;
        }
    }
}
