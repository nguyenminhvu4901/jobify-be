<?php

namespace App\Commands\Profile\UserActivity\GetDetailListOfUserActivity;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserActivity;
use App\Http\Resources\Profile\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;
use Illuminate\Support\Facades\Cache;

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
            $cache = Cache::tags([UserActivity::TAG_NAME->value])->has(
                generateCacheName(
                    UserActivity::DETAIL_LIST_USER_ACTIVITY->value,
                    $command
                )
            );

            $userActivity = Cache::tags([UserActivity::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivity::DETAIL_LIST_USER_ACTIVITY->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userActivityRepository->findWithRelationships(
                    id: $command->userActivityId,
                    relationship: ['user', 'userActivityResources.contentType']
                )
            );


            if(empty($userActivity)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserActivityResource::make($userActivity),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
