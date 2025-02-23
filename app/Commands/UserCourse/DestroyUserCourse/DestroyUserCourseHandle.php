<?php

namespace App\Commands\UserCourse\DestroyUserCourse;

use App\Repositories\UserCourse\UserCourseRepository;
use App\Repositories\UserCourseResource\UserCourseResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
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

            DB::beginTransaction();

            $userCourse->userCourseResources?->each(function ($eachUserExperienceResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserExperienceResource);
                $this->userCourseResourceRepository->destroy($eachUserExperienceResource);
            });

            $userCourseDestroy = $this->userCourseRepository->destroy($userCourse);

            if($userCourseDestroy){
                DB::commit();

                return [
                    'userCourseDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error')
            ];

        }catch (\Exception $e){
            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e
            ];
        }
    }
}
