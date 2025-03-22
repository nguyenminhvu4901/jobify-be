<?php

namespace App\Commands\Profile\UserProduct\GetDetailListOfUserProductByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProduct;
use App\Http\Resources\Profile\UserProduct\UserProductResource;
use App\Repositories\UserProduct\UserProductRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserProductByUserSlugHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     */
    public function __construct(
        protected UserProductRepository $userProductRepository
    )
    {
    }

    public function handle(GetDetailListOfUserProductByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProduct::TAG_NAME->value])->has(
                generateCacheName(
                    UserProduct::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value,
                    $command
                )
            );

            $userProduct = Cache::tags([UserProduct::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProduct::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userProductRepository->getByRelationshipUserSlug(
                    $command->userSlug,
                    ['userProductResources.contentType', 'user']
                )
            );

            return [
                'data' => UserProductResource::collection($userProduct),
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
