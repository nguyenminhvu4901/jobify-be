<?php

namespace App\Commands\UserCourse\UpdateUserCourse;

use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use App\Services\UserCourse\UserCourseService;

class UpdateUserCourseHandle
{
    public function __construct(
        protected UserCourseRepository $userCourseRepository,
        protected UserCourseService $userCourseService
    )
    {
    }

    public function handle(UpdateUserCourseCommand $command)
    {
        try {
            $userCourse = $this->userCourseRepository->updateUserCourse([
                'name' => $command->name,
                'organization' => $command->organization,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description,
            ], $command->userCourseId);

            if(!empty($command->attachments)){
                $attachments = $command->attachments;
                $userCourseResource = $userCourse->userCourseResources;



            }

            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userCourse' => UserCourseResource::make($userCourse)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
