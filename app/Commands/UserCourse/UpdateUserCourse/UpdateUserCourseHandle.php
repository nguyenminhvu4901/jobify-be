<?php

namespace App\Commands\UserCourse\UpdateUserCourse;

use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use App\Services\UserCourse\UserCourseService;

class UpdateUserCourseHandle
{
    /**
     * @param UserCourseRepository $userCourseRepository
     * @param UserCourseService $userCourseService
     */
    public function __construct(
        protected UserCourseRepository $userCourseRepository,
        protected UserCourseService $userCourseService
    )
    {
    }

    /**
     * @param UpdateUserCourseCommand $command
     * @return array
     */
    public function handle(UpdateUserCourseCommand $command): array
    {
        try {
            $userCourse = $this->userCourseRepository->updateUserCourse([
                'name' => $command->name,
                'organization' => $command->organization,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description,
            ], $command->userCourseId);

            if($userCourse){
                if(!empty($command->attachments)){

                    $this->userCourseService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userCourseResource: $userCourse?->userCourseResources,
                        userCourseId: $command->userCourseId
                    );
                }

                $userCourse->load(['userCourseResources.contentType', 'user']);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userCourse' => UserCourseResource::make($userCourse)
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error'),
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
