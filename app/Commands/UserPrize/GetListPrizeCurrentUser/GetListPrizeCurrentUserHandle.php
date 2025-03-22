<?php

namespace App\Commands\UserPrize\GetListPrizeCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserPrize;
use App\Http\Resources\Profile\UserPrize\CurrentUserPrizeResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListPrizeCurrentUserHandle
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserPrize::TAG_NAME->value])->has(
                UserPrize::LIST_PRIZE_CURRENT_USER->value . auth()->user()->id);

            $userPrizes = Cache::tags([UserPrize::TAG_NAME->value])
                ->remember(
                    UserPrize::LIST_PRIZE_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        auth()->user()->id,
                        'userPrizes.userPrizeResources.contentType',
                        [
                            'userPrizes' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userPrizes)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserPrizeResource::make($userPrizes),
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
