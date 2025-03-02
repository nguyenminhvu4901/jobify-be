<?php

namespace App\Commands\UserActivity\GetDetailListOfUserActivity;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserActivity;
use App\Http\Resources\UserActivity\UserActivityResource;
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
                UserActivity::DETAIL_LIST_USER_ACTIVITY->value . $command->userActivityId);

            $userActivity = Cache::tags([UserActivity::TAG_NAME->value])->remember(
                UserActivity::DETAIL_LIST_USER_ACTIVITY->value . $command->userActivityId,
                CacheTTL::REMEMBER->value, function () use($command){

                return $this->userActivityRepository->findWithRelationships(
                    $command->userActivityId,
                    ['user', 'userActivityResources.contentType']
                );
            });


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
