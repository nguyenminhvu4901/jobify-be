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
                userSlug: $command->userSlug,
                idColumn: $command->userCertificationId,
                relationship: 'userCertificationResources'
            );

            if (!$userCertification) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if($userCertification->userCertificationResources->isNotEmpty()){
                foreach ($userCertification->userCertificationResources as $resource){
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userCertificationResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userCertificationRepository->destroyDataWithTransaction($userCertification->id);

            if ($result['success']) {
                return [
                    'userCertificationDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success'),
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $result['error'] ?? null,
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
