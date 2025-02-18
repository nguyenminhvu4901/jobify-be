<?php

namespace App\Commands\UserCourse\DestroyUserCourse;

use App\Repositories\UserCourse\UserCourseRepository;
use App\Repositories\UserCourseResource\UserCourseResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

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
                $command->userSlug, $command->userCourseId, 'userCourseResources'
            );

            if (!$userCourse) {
                return [
                    'message' => __('messages.profile.user_destroy_profile_error')
                ];
            }

            $userCourse->userCourseResources?->each(function ($eachUserExperienceResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserExperienceResource);
                $this->userCourseResourceRepository->destroy($eachUserExperienceResource);
            });

            $userCourseDestroy = $this->userCourseRepository->destroy($userCourse);

            if($userCourseDestroy){
                return [
                    'userCourseDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error')
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e
            ];
        }
    }
}
