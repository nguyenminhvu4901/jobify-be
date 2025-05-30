<?php

namespace App\Services\ProfileSeries\UserCourse;

use App\Enums\DefaultContentType;
use App\Repositories\ProfileSeries\UserCourseResource\UserCourseResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use App\Traits\MediaResources\ImageHandler;
use App\Traits\MediaResources\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserCourseService
{
    use ImageHandler, VideoHandler;

    /**
     * @param AttachmentResourceService $attachmentResourceService
     * @param UserCourseResourceRepository $userCourseResourceRepository
     */
    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserCourseResourceRepository $userCourseResourceRepository
    )
    {
    }

    /**
     * @param $attachment
     * @return mixed
     */
    public function saveAttachment($attachment): mixed
    {
        return $this->attachmentResourceService->saveFileAttachment(
            attachment: $attachment, lastFolderName: 'courses'
        );
    }

    /**
     * @param array $attachment
     * @param string|int $userCourseId
     * @param string|null $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeUserCourseResource(
        array $attachment, string|int $userCourseId, string|null $pathStorage
    ): mixed
    {
        return $this->userCourseResourceRepository->storeDataWithTransaction([
            'user_course_id' => $userCourseId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param array $attachment
     * @param string|int $userCourseResourceId
     * @param string|null $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     */
    private function updateUserCourseResource(
        array $attachment, string|int $userCourseResourceId, string|null $pathStorage
    ): mixed
    {
        return $this->userCourseResourceRepository->updateDataWithTransaction(
            [
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ],
            $userCourseResourceId
        );
    }


    /**
     * @param $attachments
     * @param $userCourseResource
     * @param $userCourseId
     * @return null
     */
    public function updateResourceAttachment(
        $attachments, $userCourseResource, $userCourseId
    ): null
    {
        $this->deleteUserCourseResourceAndAttachment(
            attachments: $attachments, userCourseResource: $userCourseResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_course_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->saveAttachment($attachment);

                 $this->storeUserCourseResource(
                    attachment: $attachment,
                    userCourseId: $userCourseId,
                    pathStorage: $pathStorage
                );
            }
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userCourseResource
     * @return mixed
     */
    private function deleteUserCourseResourceAndAttachment($attachments, $userCourseResource): mixed
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userCourseResource,
            idName: 'user_course_resource_id'
        );

        $listUserCourseResourceToDelete = $this->userCourseResourceRepository
            ->getByIds($listDelIds);

        if(!empty($listUserCourseResourceToDelete)){
            return $listUserCourseResourceToDelete->map(function ($eachUserCourseResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserCourseResource);
                $this->userCourseResourceRepository->destroyDataWithTransaction($eachUserCourseResource->id);
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
        $userCourseResource = $this->userCourseResourceRepository
            ->find($attachment['user_course_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userCourseResource);
                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserCourseResource(
                    attachment: $attachment,
                    userCourseResourceId: $userCourseResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserCourseResource(
                attachment: $attachment,
                userCourseResourceId: $userCourseResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }
}
