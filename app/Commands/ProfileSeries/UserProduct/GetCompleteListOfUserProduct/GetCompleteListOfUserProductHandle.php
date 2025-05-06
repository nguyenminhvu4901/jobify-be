<?php

namespace App\Commands\ProfileSeries\UserProduct\GetCompleteListOfUserProduct;

use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserProduct\UserProductResource;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepository;

class GetCompleteListOfUserProductHandle
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
     * @param GetCompleteListOfUserProductCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserProductCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([UserProductEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserProductEnum::COMPLETE_LIST_USER_PRODUCT->value,
                        $command
                    )
                );

            $userProducts = redisCacheDB()->tags([UserProductEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProductEnum::COMPLETE_LIST_USER_PRODUCT->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userProductRepository->paginateWithRelationship(
                    relationship: ['userProductResources.contentType', 'user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserProductResource::collection($userProducts),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userProducts ?? [])
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
