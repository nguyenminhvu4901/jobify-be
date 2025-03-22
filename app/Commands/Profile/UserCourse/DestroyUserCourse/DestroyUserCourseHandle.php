<?php

namespace App\Commands\Profile\UserCourse\DestroyUserCourse;

use App\Repositories\UserCourse\UserCourseRepository;
use App\Repositories\UserCourseResource\UserCourseResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserCourseHandle
{
    /**
     * @param UserCourseRepository $userCourseRepository
     * @param UserCourseResourceRepository $userCourseResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserCourseRepository $userCourseRepository,
        protected UserCourseResourceRepository $userCourseResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserCourseCommand $command
     * @return array
     */
    public function handle(DestroyUserCourseCommand $command): array
    {
        try {
            $userCourse = $this->userCourseRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userCourseId,
                relationship: 'userCourseResources'
            );

            if (!$userCourse) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if($userCourse->userCourseResources->isNotEmpty()){
                foreach ($userCourse->userCourseResources as $resource){
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userCourseResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userCourseRepository->destroyDataWithTransaction($userCourse->id);

            if($result['success']){

                return [
                    'userCourseDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success')
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
