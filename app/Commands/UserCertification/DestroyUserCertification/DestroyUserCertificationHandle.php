<?php

namespace App\Commands\UserCertification\DestroyUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     * @param UserCertificationResourceRepository $userCertificationResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationResourceRepository $userCertificationResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserCertificationCommand $command
     * @return array
     */
    public function handle(DestroyUserCertificationCommand $command): array
    {
        try {
            $userCertification = $this->userCertificationRepository->findByRelationshipUserSlugAndColumnDetailId(
                $command->userSlug, $command->userCertificationId, 'userCertificationResources'
            );

            if (!$userCertification) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if(!empty($userCertification)){

                $userCertificationResource = $userCertification->userCertificationResources;

                if(!empty($userCertificationResource)){
                    $userCertificationResource->map(function ($eachUserCertificationResource) {
                        $this->attachmentResourceService->deleteFileAttachment($eachUserCertificationResource);
                        $this->userCertificationResourceRepository->destroy($eachUserCertificationResource);
                    });
                }

                $userCertificationDelete = $this->userCertificationRepository->destroy($userCertification);

                if (!empty($userCertificationDelete)) {
                    return [
                        'userCertificationDelete' => $userCertificationDelete,
                        'message' => __('messages.profile.user_destroy_profile_success')
                    ];
                }
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
