<?php

namespace App\Commands\UserActivity\StoreUserActivity;

use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;
use App\Services\UserActivity\UserActivityService;

class StoreUserActivityHandle
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
     * @param StoreUserActivityCommand $command
     * @return array
     */
    public function handle(StoreUserActivityCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userActivity = $this->userActivityRepository->store([
                'user_id' => $userId,
                'name' => $command->name,
                'position' => $command->position,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description
            ]);

            if($userActivity){
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    foreach ($attachments as $attachment)
                    {
                        $pathStorage = $this->userActivityService->saveAttachment($attachment);

                        if(!empty($pathStorage)){
                            $this->userActivityService->storeUserActivityResource(
                                attachment: $attachment,
                                userActivityId: $userActivity->id,
                                pathStorage: $pathStorage
                            );
                        }
                    }
                }

                $userActivity->load(['userActivityResources.contentType', 'user']);

                return [
                    'userActivity' => UserActivityResource::make($userActivity),
                    'message' => __('messages.profile.user_update_profile_success')
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
