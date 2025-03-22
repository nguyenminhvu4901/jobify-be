<?php

namespace App\Commands\Profile\UserActivity\DestroyUserActivity;

use App\Repositories\UserActivity\UserActivityRepository;
use App\Repositories\UserActivityResource\UserActivityResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserActivityHandle
{
    /**
     * @param UserActivityRepository $userActivityRepository
     * @param UserActivityResourceRepository $userActivityResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserActivityRepository $userActivityRepository,
        protected UserActivityResourceRepository $userActivityResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserActivityCommand $command
     * @return array
     */
    public function handle(DestroyUserActivityCommand $command): array
    {
        try {
            $userActivity = $this->userActivityRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userActivityId,
                relationship: 'userActivityResources'
            );

            if (!$userActivity) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if ($userActivity->userActivityResources?->isNotEmpty()) {
                foreach ($userActivity->userActivityResources as $resource) {
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userActivityResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userActivityRepository->destroyDataWithTransaction($userActivity->id);

            if ($result['success']) {
                return [
                    'userActivityDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success'),
                ];
            }

            return [
                'message' => $result['message'] ?? __('messages.profile.user_destroy_profile_error'),
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
