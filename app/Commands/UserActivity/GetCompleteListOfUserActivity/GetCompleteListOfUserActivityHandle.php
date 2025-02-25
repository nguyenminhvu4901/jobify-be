<?php

namespace App\Commands\UserActivity\GetCompleteListOfUserActivity;

use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;

class GetCompleteListOfUserActivityHandle
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userActivities = $this->userActivityRepository->getWithRelationship(
                ['userActivityResources.contentType', 'user']
            );

            return [
                'userActivities' => UserActivityResource::collection($userActivities),
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
