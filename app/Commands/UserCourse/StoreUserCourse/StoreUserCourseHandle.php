<?php

namespace App\Commands\UserCourse\StoreUserCourse;

use App\Http\Resources\UserCertification\UserCertificationResource;
use App\Http\Resources\UserCourse\UserCourseResource;
use App\Repositories\UserCourse\UserCourseRepository;
use App\Services\UserCourse\UserCourseService;

class StoreUserCourseHandle
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
     * @param StoreUserCourseCommand $command
     * @return array
     */
    public function handle(StoreUserCourseCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userCourse = $this->userCourseRepository->create([
                'user_id' => $userId,
                'name' => $command->name,
                'organization' => $command->organization,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description,
            ]);

            if(!empty($command->attachments)){
                $attachments = $command->attachments;

                foreach ($attachments as $attachment){
                    $pathStorage = $this->userCourseService->processSaveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userCourseService->storeUserCourseResource(
                            attachment: $attachment,
                            userCourseId: $userCourse->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
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
