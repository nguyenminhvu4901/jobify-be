<?php

namespace App\Commands\UserActivity\UpdateUserActivity;

use App\Http\Resources\UserActivity\UserActivityResource;
use App\Http\Resources\UserProduct\UserProductResource;
use App\Repositories\UserActivity\UserActivityRepository;
use App\Services\UserActivity\UserActivityService;

class UpdateUserActivityHandle
{
    /**
     * @param UserActivityRepository $userActivityRepository
     * @param UserActivityService $userActivityService
     */
    public function __construct(
        protected UserActivityRepository $userActivityRepository,
        protected UserActivityService $userActivityService
    )
    {
    }

    /**
     * @param UpdateUserActivityCommand $command
     * @return array
     */
    public function handle(UpdateUserActivityCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userActivity = $this->userActivityRepository->updateUserActivity([
                'user_id' => $userId,
                'name' => $command->name,
                'position' => $command->position,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description
            ], $command->userActivityId);

            if($userActivity){
                if(!empty($command->attachments)){

                    $this->userActivityService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userActivityResource: $userActivity->userActivityResources,
                        userActivityId: $command->userActivityId
                    );
                }

                $userActivity->load(['userActivityResources.contentType', 'user']);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userActivity' => UserActivityResource::make($userActivity)
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
