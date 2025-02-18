<?php

namespace App\Services\UserCertification;

use App\Enums\DefaultContentType;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserCertificationService
{
    use ImageHandler, VideoHandler;

    /**
     * @param AttachmentResourceService $attachmentResourceService
     * @param UserCertificationResourceRepository $userCertificationResourceRepository
     */
    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserCertificationResourceRepository $userCertificationResourceRepository
    )
    {
    }

    /**
     * @param $attachment
     * @return void|null
     */
    public function saveAttachment($attachment)
    {
        return $this->attachmentResourceService->saveFileAttachment(
            attachment: $attachment, lastFolderName: 'certifications'
        );
    }

    /**
     * @param $attachment
     * @param $userCertificationId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeUserCertificationResource($attachment, $userCertificationId, $pathStorage): mixed
    {
        return $this->userCertificationResourceRepository->store([
            'user_certification_id' => $userCertificationId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param $attachments
     * @param $userCertificationResource
     * @param $userCertificationId
     * @return void
     */
    public function updateResourceAttachment(
        $attachments, $userCertificationResource, $userCertificationId
    ): void
    {
        $this->deleteUserCertificationResourceAndAttachment(
            attachments: $attachments, userCertificationResource: $userCertificationResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_certification_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->saveAttachment($attachment);
                $this->storeUserCertificationResource(
                    attachment: $attachment,
                    userCertificationId: $userCertificationId,
                    pathStorage: $pathStorage
                );
            }
        }
    }


    /**
     * @param $attachment
     * @return LengthAwarePaginator|Collection|mixed|void|null
     */
    private function processUpdateAttachment($attachment)
    {
        $userCertificationResource = $this->userCertificationResourceRepository
            ->find($attachment['user_certification_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userCertificationResource);

                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserCertificationResource(
                    attachment: $attachment,
                    userCertificationResourceId: $userCertificationResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserCertificationResource(
                attachment: $attachment,
                userCertificationResourceId: $userCertificationResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }

    /**
     * @param $attachment
     * @param $userCertificationResourceId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    private function updateUserCertificationResource($attachment, $userCertificationResourceId, $pathStorage): mixed
    {
        return $this->userCertificationResourceRepository->updateUserCertificationResource([
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ], $userCertificationResourceId);
    }

    /**
     * @param $attachments
     * @param $userCertificationResource
     * @return mixed
     */
    private function deleteUserCertificationResourceAndAttachment($attachments, $userCertificationResource): mixed
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userCertificationResource,
            idName: 'user_certification_resource_id'
        );

        $listUserCertificationResourceToDelete = $this->userCertificationResourceRepository
                                                    ->getListUserCertificationResourceByIds($listDelIds);

        if(!empty($listUserCertificationResourceToDelete)){
            return $listUserCertificationResourceToDelete->map(function ($eachUserCertificationResource) {

               $this->attachmentResourceService->deleteFileAttachment($eachUserCertificationResource);
               $this->userCertificationResourceRepository->destroy($eachUserCertificationResource);
            });
        }

        return null;
    }
}
