<?php

namespace App\Commands\UserCourse\GetCompleteListOfUserCourse;

use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use Exception;

class GetCompleteListOfUserCourseHandle
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userCourses = $this->userCourseRepository->getWithRelationship(
                ['userCourseResources', 'user']
            );

            return [
                'userCourses' => $userCourses,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error')
            ];
        }
    }
}
