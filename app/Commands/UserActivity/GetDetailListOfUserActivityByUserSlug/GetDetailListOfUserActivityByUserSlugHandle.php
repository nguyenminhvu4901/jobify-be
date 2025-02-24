<?php

namespace App\Commands\UserActivity\GetDetailListOfUserActivityByUserSlug;

use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;

class GetDetailListOfUserActivityByUserSlugHandle
{
    public function __construct(
        protected UserActivityRepository $userActivityRepository
    )
    {
    }

    public function handle(GetDetailListOfUserActivityByUserSlugCommand $command): array
    {
        try {
            $userActivity = $this->userActivityRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userActivityResources.contentType', 'user']
            );

            return [
                'userActivity' => UserActivityResource::collection($userActivity),
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
