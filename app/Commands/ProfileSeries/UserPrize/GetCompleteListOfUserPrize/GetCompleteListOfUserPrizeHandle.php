<?php

namespace App\Commands\ProfileSeries\UserPrize\GetCompleteListOfUserPrize;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Http\Resources\ProfileSeries\UserPrize\UserPrizeResource;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserPrizeHandle
{
    /**
     * @param UserPrizeRepository $userPrizeRepository
     */
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository
    )
    {
    }

    /**
     * @param GetCompleteListOfUserPrizeCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserPrizeCommand $command): array
    {
        try {
            $cache = Cache::tags([UserPrizeEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserPrizeEnum::COMPLETE_LIST_USER_PRIZE->value,
                        $command
                    )
                );

            $userPrizes = Cache::tags([UserPrizeEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserPrizeEnum::COMPLETE_LIST_USER_PRIZE->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userPrizeRepository->getWithRelationship(
                    ['userPrizeResources.contentType', 'user']
                )
            );

            return [
                'data' => UserPrizeResource::collection($userPrizes),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userPrizes ?? [])
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
