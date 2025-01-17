<?php

namespace App\Services\UserCertification;

use App\Enums\DefaultContentType;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class UserCertificationService
{
    use ImageHandler, VideoHandler;

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
    public function processSaveAttachment($attachment)
    {
        $user = auth()->user();

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value) {
            $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/certifications';
            $pathStorage = $this->storeImage($attachment['content'], $path, $user);

        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $pathStorage = $attachment['content'];

        } elseif ($attachment['content_type_id'] == DefaultContentType::VIDEO->value) {
            $path = 'videos/profiles/' . extractEmailPrefix($user->email) . '/certifications';
            $pathStorage = $this->storeVideo($attachment['content'], $path, $user);

        } else {
            return null;
        }

        return $pathStorage;
    }

    /**
     * @param $attachment
     * @param $userCertificationId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function storeUserCertificationResource($attachment, $userCertificationId, $pathStorage): mixed
    {
        return $this->userCertificationResourceRepository->create([
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
     * @return mixed
     * @throws ValidatorException
     */
    public function updateResourceAttachment(
        $attachments, $userCertificationResource, $userCertificationId
    ): mixed
    {
        $this->deleteUserCertificationResourceAndAttachment($attachments, $userCertificationResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_certification_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{
                $pathStorage = $this->processSaveAttachment($attachment);
                $this->storeUserCertificationResource($attachment, $userCertificationId, $pathStorage);
            }
        }

        return null;
    }

    /**
     * @param $attachment
     * @return void|null
     * @throws ValidatorException
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

                $pathStorage = $this->processSaveAttachment($attachment);
                $this->updateUserCertificationResource($attachment, $userCertificationResource->id, $pathStorage);
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $this->updateUserCertificationResource($attachment, $userCertificationResource->id, $attachment['content']);
        }else {
            return null;
        }
    }

    /**
     * @param $attachment
     * @param $userCertificationResourceId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    private function updateUserCertificationResource($attachment, $userCertificationResourceId, $pathStorage): mixed
    {
        return $this->userCertificationResourceRepository->update([
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
            $attachments, $userCertificationResource, 'user_certification_resource_id'
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
