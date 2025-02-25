<?php

namespace App\Commands\UserActivity\DestroyUserActivity;

use App\Repositories\UserActivity\UserActivityRepository;
use App\Repositories\UserActivityResource\UserActivityResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
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

            DB::beginTransaction();

            $userActivity?->userActivityResources?->each(function ($eachUserActivityResources) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserActivityResources);
                $this->userActivityResourceRepository->destroy($eachUserActivityResources);
            });

            $userActivityDestroy = $this->userActivityRepository->destroy($userActivity);

            if ($userActivityDestroy) {
                DB::commit();

                return [
                    'userActivityDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success'),
                ];
            }

            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
