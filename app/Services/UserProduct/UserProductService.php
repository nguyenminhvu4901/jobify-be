<?php

namespace App\Services\UserProduct;

use App\Enums\DefaultContentType;
use App\Repositories\UserProductResource\UserProductResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserProductService
{
    use ImageHandler, VideoHandler;

    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserProductResourceRepository $userProductResourceRepository
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
            attachment: $attachment, lastFolderName: 'products'
        );
    }

    /**
     * @param array $attachment
     * @param string|int $userProductId
     * @param string|null $pathStorage
     * @return mixed
     */
    public function storeUserProductResource(
        array $attachment,
        string|int $userProductId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userProductResourceRepository->storeDataWithTransaction([
            'user_product_id' => $userProductId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }

    /**
     * @param array $attachment
     * @param string|int $userProductResourceId
     * @param string|null $pathStorage
     * @return mixed
     */
    private function updateUserPrizeResource(
        array $attachment,
        string|int $userProductResourceId,
        string|null $pathStorage
    ): mixed
    {
        return $this->userProductResourceRepository->updateDataWithTransaction(
            [
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ], $userProductResourceId);
    }

    /**
     * @param $attachments
     * @param $userProductResource
     * @param $userProductId
     * @return null
     */
    public function updateResourceAttachment(
        $attachments, $userProductResource, $userProductId
    ): null
    {
        $this->deleteUserProductResourceAndAttachment(
            attachments: $attachments, userProductResource: $userProductResource);

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_product_resource_id'])){
                $this->processUpdateAttachment($attachment);
            }else{

                $pathStorage = $this->saveAttachment($attachment);

                $this->storeUserProductResource(
                    attachment: $attachment,
                    userProductId: $userProductId,
                    pathStorage: $pathStorage
                );
            }
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userProductResource
     * @return null
     */
    private function deleteUserProductResourceAndAttachment($attachments, $userProductResource): null
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userProductResource,
            idName: 'user_product_resource_id'
        );

        $listUserProductResourceToDelete = $this->userProductResourceRepository
            ->getByIds($listDelIds);

        if(!empty($listUserProductResourceToDelete)){
            $listUserProductResourceToDelete->map(function ($eachUserProductResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserProductResource);
                $this->userProductResourceRepository->destroyDataWithTransaction($eachUserProductResource);
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
        $userProductResource = $this->userProductResourceRepository
            ->find($attachment['user_product_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if(is_string($attachment['content'])){
                return ;
            }else{
                $this->attachmentResourceService->deleteFileAttachment($userProductResource);
                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserPrizeResource(
                    attachment: $attachment,
                    userProductResourceId: $userProductResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserPrizeResource(
                attachment: $attachment,
                userProductResourceId: $userProductResource->id,
                pathStorage: $attachment['content']
            );
        }else {
            return null;
        }
    }
}
