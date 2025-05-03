<?php

namespace App\Commands\ProfileSeries\UserPrize\GetDetailListOfUserPrize;

use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserPrize\UserPrizeResource;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserPrizeHandle
{
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository
    ) {
    }

    public function handle(GetDetailListOfUserPrizeCommand $command): array
    {
        try {
            $cache = Cache::tags([UserPrizeEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserPrizeEnum::DETAIL_LIST_USER_PRIZE->value,
                    $command
                )
            );

            $userPrize = Cache::tags([UserPrizeEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserPrizeEnum::DETAIL_LIST_USER_PRIZE->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn () => $this->userPrizeRepository->findWithRelationships(
                        $command->userPrizeId,
                        ['user', 'userPrizeResources.contentType']
                    )
                );

            if (empty($userPrize)) {
                return [
                    'message' => __('messages.profile.user_get_profile_error'),
                ];
            }

            return [
                'data' => UserPrizeResource::make($userPrize),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
            ];
        } catch (\Exception $e) {
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
            ];
        }
    }
}
