<?php

namespace App\Services\ProfileSeries\UserActivity;

use App\Enums\DefaultContentType;
use App\Repositories\ProfileSeries\UserActivityResource\UserActivityResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use App\Traits\MediaResources\ImageHandler;
use App\Traits\MediaResources\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserActivityService
{
    use ImageHandler, VideoHandler;

    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserActivityResourceRepository $userActivityResourceRepository
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
            attachment: $attachment, lastFolderName: 'activities'
        );
    }

    /**
     * @param $attachment
     * @param $userActivityId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeUserActivityResource($attachment, $userActivityId, $pathStorage): mixed
    {
        return $this->userActivityResourceRepository->storeDataWithTransaction([
            'user_activity_id' => $userActivityId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param $attachment
     * @param $userActivityResourceId
     * @param $pathStorage
     * @return array
     */
    private function updateUserActivityResource($attachment, $userActivityResourceId, $pathStorage): array
    {
        return $this->userActivityResourceRepository->updateDataWithTransaction([
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ], $userActivityResourceId);
    }

    /**
     * @param $attachments
     * @param $userActivityResource
     * @param $userActivityId
     * @return void
     */
    public function updateResourceAttachment(
        $attachments, $userActivityResource, $userActivityId
    ): void
    {
        $this->deleteUserActivityResourceAndAttachment(
            attachments: $attachments, userActivityResource: $userActivityResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_activity_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->saveAttachment($attachment);
                $this->storeUserActivityResource(
                    attachment: $attachment,
                    userActivityId: $userActivityId,
                    pathStorage: $pathStorage
                );
            }
        }
    }

    /**
     * @param $attachment
     * @return array|void|null
     */
    private function processUpdateAttachment($attachment)
    {
        $userActivityResource = $this->userActivityResourceRepository
            ->find($attachment['user_activity_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userActivityResource);

                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserActivityResource(
                    attachment: $attachment,
                    userActivityResourceId: $userActivityResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserActivityResource(
                attachment: $attachment,
                userActivityResourceId: $userActivityResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }

    /**
     * @param $attachments
     * @param $userActivityResource
     * @return mixed
     */
    private function deleteUserActivityResourceAndAttachment($attachments, $userActivityResource): mixed
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userActivityResource,
            idName: 'user_activity_resource_id'
        );

        $listUserActivityResourceToDelete = $this->userActivityResourceRepository
            ->getByIds($listDelIds);

        if(!empty($listUserActivityResourceToDelete)){
            return $listUserActivityResourceToDelete->map(function ($eachUserActivityResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserActivityResource);
                $this->userActivityResourceRepository->destroyDataWithTransaction($eachUserActivityResource->id);
            });
        }

        return null;
    }
}
