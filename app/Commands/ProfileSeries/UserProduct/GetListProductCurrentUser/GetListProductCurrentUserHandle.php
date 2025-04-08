<?php

namespace App\Commands\ProfileSeries\UserProduct\GetListProductCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Http\Resources\ProfileSeries\UserProduct\CurrentUserProductResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListProductCurrentUserHandle
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
            $cache = Cache::tags([UserProductEnum::TAG_NAME->value])->has(
                UserProductEnum::LIST_PRODUCT_CURRENT_USER->value . auth()->user()->id
            );

            $userProducts = Cache::tags([UserProductEnum::TAG_NAME->value])
                ->remember(
                    UserProductEnum::LIST_PRODUCT_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        auth()->user()->id,
                        'userProducts.userProductResources.contentType',
                        [
                            'userProducts' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userProducts)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserProductResource::make($userProducts),
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
