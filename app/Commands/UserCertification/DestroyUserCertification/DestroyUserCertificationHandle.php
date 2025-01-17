<?php

namespace App\Commands\UserCertification\DestroyUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

class DestroyUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationResourceRepository $userCertificationResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserCertificationCommand $command
     * @return ?bool
     */
    public function handle(DestroyUserCertificationCommand $command): ?bool
    {
        $userCertification = $this->userCertificationRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userCertificationId, 'userCertificationResources'
        );

        if(!empty($userCertification)){

            $userCertificationResource = $userCertification->userCertificationResources;

            if(!empty($userCertificationResource)){
                $userCertificationResource->map(function ($eachUserCertificationResource) {
                    $this->attachmentResourceService->deleteFileAttachment($eachUserCertificationResource);
                    $this->userCertificationResourceRepository->destroy($eachUserCertificationResource);
                });
            }

            return $this->userCertificationRepository->destroy($userCertification);
        }

        return false;
    }
}
