<?php

namespace App\Commands\ProfileSeries\UserActivity\GetCompleteListOfUserActivity;

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepository;

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
            $cache = redisCacheDB()->tags([UserActivityEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserActivityEnum::COMPLETE_LIST_USER_ACTIVITY->value,
                        $command
                    )
                );

            $userActivities = redisCacheDB()->tags([UserActivityEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserActivityEnum::COMPLETE_LIST_USER_ACTIVITY->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userActivityRepository->paginateWithRelationship(
                    relationship: ['userActivityResources.contentType', 'user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => JobListingResource::collection($userActivities),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userActivities ?? [])
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
