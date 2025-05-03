<?php

namespace App\Services\ProfileSeries\UserPrize;

use App\Enums\DefaultContentType;
use App\Repositories\ProfileSeries\UserPrizeResource\UserPrizeResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserPrizeService
{
    use ImageHandler;
    use VideoHandler;

    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserPrizeResourceRepository $userPrizeResourceRepository
    ) {
    }

    /**
     * @return void|null
     */
    public function saveAttachment($attachment)
    {
        return $this->attachmentResourceService->saveFileAttachment(
            attachment: $attachment,
            lastFolderName: 'prizes'
        );
    }

    public function storeUserPrizeResource(
        array $attachment,
        string|int $userPrizeId,
        ?string $pathStorage
    ): mixed {
        return $this->userPrizeResourceRepository->storeDataWithTransaction([
            'user_prize_id' => $userPrizeId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id'],
        ]);
    }

    private function updateUserPrizeResource(
        array $attachment,
        string|int $userPrizeResourceId,
        ?string $pathStorage
    ): mixed {
        return $this->userPrizeResourceRepository->updateDataWithTransaction(
            [
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id'],
            ],
            $userPrizeResourceId
        );
    }

    public function updateResourceAttachment(
        $attachments,
        $userPrizeResource,
        $userPrizeId
    ): null {
        $this->deleteUserPrizeResourceAndAttachment(
            attachments: $attachments,
            userPrizeResource: $userPrizeResource
        );

        foreach ($attachments as $attachment) {
            if (! empty($attachment['user_prize_resource_id'])) {
                $this->processUpdateAttachment($attachment);
            } else {

                $pathStorage = $this->saveAttachment($attachment);

                $this->storeUserPrizeResource(
                    attachment: $attachment,
                    userPrizeId: $userPrizeId,
                    pathStorage: $pathStorage
                );
            }
        }

        return null;
    }

    private function deleteUserPrizeResourceAndAttachment($attachments, $userPrizeResource): null
    {
        $listDelIds = $this->attachmentResourceService->getListRedundantIdsToDelete(
            attachments: $attachments,
            userModelResource: $userPrizeResource,
            idName: 'user_prize_resource_id'
        );

        $listUserPrizeResourceToDelete = $this->userPrizeResourceRepository
            ->getByIds($listDelIds);

        if (! empty($listUserPrizeResourceToDelete)) {
            $listUserPrizeResourceToDelete->map(function ($eachUserPrizeResource) {

                $this->attachmentResourceService->deleteFileAttachment($eachUserPrizeResource);
                $this->userPrizeResourceRepository->destroyDataWithTransaction($eachUserPrizeResource->id);
            });
        }

        return null;
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed|void|null
     */
    public function processUpdateAttachment($attachment)
    {
        $userPrizeResource = $this->userPrizeResourceRepository
            ->find($attachment['user_prize_resource_id']);

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value ||
            $attachment['content_type_id'] == DefaultContentType::VIDEO->value
        ) {
            if (is_string($attachment['content'])) {
                return;
            } else {
                $this->attachmentResourceService->deleteFileAttachment($userPrizeResource);
                $pathStorage = $this->saveAttachment($attachment);

                return $this->updateUserPrizeResource(
                    attachment: $attachment,
                    userPrizeResourceId: $userPrizeResource->id,
                    pathStorage: $pathStorage
                );
            }
        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {

            return $this->updateUserPrizeResource(
                attachment: $attachment,
                userPrizeResourceId: $userPrizeResource->id,
                pathStorage: $attachment['content']
            );
        } else {
            return null;
        }
    }
}
