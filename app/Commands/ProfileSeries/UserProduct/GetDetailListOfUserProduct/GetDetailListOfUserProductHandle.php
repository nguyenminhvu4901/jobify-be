<?php

namespace App\Commands\ProfileSeries\UserProduct\GetDetailListOfUserProduct;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Http\Resources\ProfileSeries\UserProduct\UserProductResource;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserProductHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     */
    public function __construct(
        protected UserProductRepository $userProductRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserProductCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserProductCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProductEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserProductEnum::DETAIL_LIST_USER_PRODUCT->value,
                    $command
                )
            );

            $userProduct = Cache::tags([UserProductEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserProductEnum::DETAIL_LIST_USER_PRODUCT->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userProductRepository->findWithRelationships(
                        $command->userProductId,
                        ['user', 'userProductResources.contentType']
                    )
                );

            if(empty($userProduct)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserProductResource::make($userProduct),
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
