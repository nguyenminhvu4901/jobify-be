<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrize;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserPrize;
use App\Http\Resources\Profile\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserPrizeHandle
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
     * @param GetDetailListOfUserPrizeCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserPrizeCommand $command): array
    {
        try {
            $cache = Cache::tags([UserPrize::TAG_NAME->value])->has(
                generateCacheName(
                    UserPrize::DETAIL_LIST_USER_PRIZE->value,
                    $command
                )
            );

            $userPrize = Cache::tags([UserPrize::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserPrize::DETAIL_LIST_USER_PRIZE->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userPrizeRepository->findWithRelationships(
                        $command->userPrizeId,
                        ['user', 'userPrizeResources.contentType']
                    )
                );

            if(empty($userPrize)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserPrizeResource::make($userPrize),
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
