<?php

namespace App\Commands\UserCourse\GetDetailListOfUserCourse;

use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;

class GetDetailListOfUserCourseHandle
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
     * @param GetDetailListOfUserCourseCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCourseCommand $command): array
    {
        try {
            $userCourse = $this->userCourseRepository->findWithRelationships(
                $command->userCourseId,
                ['user', 'userCourseResources.contentType']
            );

            if(empty($userCourse)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserCourseResource::make($userCourse),
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
