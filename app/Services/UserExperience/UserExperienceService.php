<?php

namespace App\Services\UserExperience;

use App\Enums\DefaultContentType;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class UserExperienceService
{
    use ImageHandler, VideoHandler;

    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
    )
    {}

    /**
     * @param $attachment
     * @return void|null
     */
    public function processSaveAttachment($attachment)
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
     * @param $attachment
     * @param $userExperienceId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function storeUserExperienceResource($attachment, $userExperienceId, $pathStorage): mixed
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
     * @throws ValidatorException
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
     * @param $attachments
     * @param $userExperienceResource
     * @param $userExperienceId
     * @return LengthAwarePaginator|Collection|mixed|null
     * @throws ValidatorException
     */
    public function updateResourceAttachment(
        $attachments, $userExperienceResource, $userExperienceId
    ): mixed
    {
        $this->deleteUserExperienceResourceAndAttachment($attachments, $userExperienceResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_experience_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->processSaveAttachment($attachment);
                $this->storeUserExperienceResource($attachment, $userExperienceId, $pathStorage);
            }
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userCertificationResource
     * @return mixed
     */
    private function deleteUserExperienceResourceAndAttachment($attachments, $userCertificationResource): mixed
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            $attachments, $userCertificationResource, 'user_experience_resource_id'
        );

        $listUserExperienceResourceToDelete = $this->userExperienceResourceRepository
            ->getListUserExperienceResourceByIds($listDelIds);

        if(!empty($listUserExperienceResourceToDelete)){
            return $listUserExperienceResourceToDelete->map(function ($eachUserCertificationResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserCertificationResource);
                $this->userExperienceResourceRepository->destroy($eachUserCertificationResource);
            });
        }

        return null;
    }

    /**
     * @param $attachment
     * @return void|null
     * @throws ValidatorException
     */
    public function processUpdateAttachment($attachment)
    {
        $userExperienceResource = $this->userExperienceResourceRepository
            ->find($attachment['user_experience_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userExperienceResource);
                $pathStorage = $this->processSaveAttachment($attachment);
                $this->updateUserExperienceResource($attachment, $userExperienceResource->id, $pathStorage);
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $this->updateUserExperienceResource($attachment, $userExperienceResource->id, $attachment['content']);
        }else {
            return null;
        }
    }
}
