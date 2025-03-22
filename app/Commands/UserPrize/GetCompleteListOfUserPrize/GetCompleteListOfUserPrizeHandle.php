<?php

namespace App\Commands\UserPrize\GetCompleteListOfUserPrize;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserPrize;
use App\Helpers\Global\PaginationHelper;
use App\Http\Resources\Profile\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;
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
            $cache = Cache::tags([UserPrize::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserPrize::COMPLETE_LIST_USER_PRIZE->value,
                        $command
                    )
                );

            $userPrizes = Cache::tags([UserPrize::TAG_NAME->value])->remember(
                generateCacheName(
                    UserPrize::COMPLETE_LIST_USER_PRIZE->value,
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
                'pagination' => PaginationHelper::formatPaginationData($userPrizes) ?? []
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
