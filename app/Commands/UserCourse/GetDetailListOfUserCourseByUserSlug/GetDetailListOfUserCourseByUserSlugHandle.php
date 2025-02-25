<?php

namespace App\Commands\UserCourse\GetDetailListOfUserCourseByUserSlug;

use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;

class GetDetailListOfUserCourseByUserSlugHandle
{
    /**
     * @param UserCourseRepository $userCourseRepository
     */
    public function __construct(
        protected UserCourseRepository $userCourseRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserCourseByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCourseByUserSlugCommand $command): array
    {
        try {
            $userCourses =  $this->userCourseRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userCourseResources.contentType', 'user']
            );

            return [
                'userCourses' => UserCourseResource::collection($userCourses),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
