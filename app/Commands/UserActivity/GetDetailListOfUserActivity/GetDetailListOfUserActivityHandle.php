<?php

namespace App\Commands\UserActivity\GetDetailListOfUserActivity;

use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;

class GetDetailListOfUserActivityHandle
{
    /**
     * @param UserActivityRepository $userActivityRepository
     */
    public function __construct(
        protected UserActivityRepository $userActivityRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserActivityCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserActivityCommand $command): array
    {
        try {
            $userActivity = $this->userActivityRepository->findWithRelationships(
                $command->userActivityId,
                ['user', 'userActivityResources.contentType']
            );

            return [
                'userActivity' => UserActivityResource::make($userActivity),
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
