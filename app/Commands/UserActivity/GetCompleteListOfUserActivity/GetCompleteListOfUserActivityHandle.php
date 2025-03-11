<?php

namespace App\Commands\UserActivity\GetCompleteListOfUserActivity;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserActivity;
use App\Http\Resources\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;
use Illuminate\Support\Facades\Cache;

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
     * @param GetCompleteListOfUserActivityCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserActivityCommand $command): array
    {
        try {
            $cache = Cache::tags([UserActivity::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserActivity::COMPLETE_LIST_USER_ACTIVITY->value,
                        $command
                    )
                );

            $userActivities = Cache::tags([UserActivity::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivity::COMPLETE_LIST_USER_ACTIVITY->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userActivityRepository->paginateWithRelationship(
                    relationship: ['userActivityResources.contentType', 'user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserActivityResource::collection($userActivities),
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
