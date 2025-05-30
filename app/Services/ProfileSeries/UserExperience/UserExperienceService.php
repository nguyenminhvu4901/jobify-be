<?php

namespace App\Services\ProfileSeries\UserExperience;

use App\Enums\DefaultContentType;
use App\Repositories\ProfileSeries\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use App\Traits\MediaResources\ImageHandler;
use App\Traits\MediaResources\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserExperienceService
{
    use ImageHandler, VideoHandler;

    /**
     * @param AttachmentResourceService $attachmentResourceService
     * @param UserExperienceResourceRepository $userExperienceResourceRepository
     */
    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
    )
    {}

    /**
     * @param $attachment
     * @return void|null
     */
    public function saveAttachment($attachment)
    {
        return $this->attachmentResourceService->saveFileAttachment(
            attachment: $attachment, lastFolderName: 'experiences'
        );
    }


    /**
     * @param array $attachment
     * @param string|int $userExperienceId
     * @param string|null $pathStorage
     * @return mixed
     */
    public function storeUserExperienceResource(
        array $attachment,
        string|int $userExperienceId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userExperienceResourceRepository->storeDataWithTransaction([
            'user_experience_id' => $userExperienceId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }


    /**
     * @param array $attachment
     * @param string|int $userExperienceResourceId
     * @param string|null $pathStorage
     * @return mixed
     */
    private function updateUserExperienceResource(
        array $attachment,
        string|int $userExperienceResourceId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userExperienceResourceRepository->updateDataWithTransaction(
            [
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
     * @return null
     */
    public function updateResourceAttachment(
        $attachments, $userExperienceResource, $userExperienceId
    ): null
    {
        $this->deleteUserExperienceResourceAndAttachment(
            attachments: $attachments, userExperienceResource: $userExperienceResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_experience_resource_id'])){

                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->saveAttachment($attachment);

                 $this->storeUserExperienceResource(
                    attachment: $attachment,
                    userExperienceId: $userExperienceId,
                    pathStorage: $pathStorage
                );
            }
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userExperienceResource
     * @return mixed
     */
    private function deleteUserExperienceResourceAndAttachment($attachments, $userExperienceResource): mixed
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userExperienceResource,
            idName: 'user_experience_resource_id'
        );

        $listUserExperienceResourceToDelete = $this->userExperienceResourceRepository
            ->getByIds($listDelIds);

        if(!empty($listUserExperienceResourceToDelete)){
            return $listUserExperienceResourceToDelete->map(function ($eachUserExperienceResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserExperienceResource);
                $this->userExperienceResourceRepository->destroyDataWithTransaction($eachUserExperienceResource->id);
            });
        }

        return null;
    }


    /**
     * @param $attachment
     * @return LengthAwarePaginator|Collection|mixed|void|null
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
                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserExperienceResource(
                    attachment: $attachment,
                    userExperienceResourceId: $userExperienceResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserExperienceResource(
                attachment: $attachment,
                userExperienceResourceId: $userExperienceResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }
}
