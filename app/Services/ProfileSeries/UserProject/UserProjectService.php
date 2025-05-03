<?php

namespace App\Services\ProfileSeries\UserProject;

use App\Enums\DefaultContentType;
use App\Repositories\ProfileSeries\UserProjectResource\UserProjectResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserProjectService
{
    use ImageHandler, VideoHandler;

    /**
     * @param AttachmentResourceService $attachmentResourceService
     * @param UserProjectResourceRepository $userProjectResourceRepository
     */
    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserProjectResourceRepository $userProjectResourceRepository
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
            attachment: $attachment, lastFolderName: 'projects'
        );
    }

    /**
     * @param array $attachment
     * @param string|int $userProjectId
     * @param string|null $pathStorage
     * @return mixed
     */
    public function storeUserProjectResource(
        array $attachment,
        string|int $userProjectId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userProjectResourceRepository->storeDataWithTransaction([
            'user_project_id' => $userProjectId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param array $attachment
     * @param string|int $userProjectResourceId
     * @param string|null $pathStorage
     * @return mixed
     */
    private function updateUserProjectResource(
        array $attachment,
        string|int $userProjectResourceId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userProjectResourceRepository->updateDataWithTransaction(
            [
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ], $userProjectResourceId);
    }

    /**
     * @param $attachments
     * @param $userProjectResource
     * @param $userProjectId
     * @return null
     */
    public function updateResourceAttachment(
        $attachments, $userProjectResource, $userProjectId
    ): null
    {
        $this->deleteUserProjectResourceAndAttachment(
            attachments: $attachments, userProjectResource: $userProjectResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_project_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{

                $pathStorage = $this->saveAttachment($attachment);

                $this->storeUserProjectResource(
                    attachment: $attachment,
                    userProjectId: $userProjectId,
                    pathStorage: $pathStorage
                );
            }
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userProjectResource
     * @return null
     */
    private function deleteUserProjectResourceAndAttachment($attachments, $userProjectResource): null
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userProjectResource,
            idName: 'user_project_resource_id'
        );

        $listUserProjectResourceToDelete = $this->userProjectResourceRepository
            ->getByIds($listDelIds);

        if(!empty($listUserProjectResourceToDelete)){
             $listUserProjectResourceToDelete->map(function ($eachUserProjectResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserProjectResource);
                $this->userProjectResourceRepository->destroyDataWithTransaction($eachUserProjectResource->id);
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
        $userProjectResource = $this->userProjectResourceRepository
            ->find($attachment['user_project_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userProjectResource);
                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserProjectResource(
                    attachment: $attachment,
                    userProjectResourceId: $userProjectResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserProjectResource(
                attachment: $attachment,
                userProjectResourceId: $userProjectResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }
}
