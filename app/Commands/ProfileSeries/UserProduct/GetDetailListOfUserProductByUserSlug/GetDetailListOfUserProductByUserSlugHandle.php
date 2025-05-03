<?php

namespace App\Commands\ProfileSeries\UserProduct\GetDetailListOfUserProductByUserSlug;

use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserProduct\UserProductResource;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserProductByUserSlugHandle
{
    public function __construct(
        protected UserProductRepository $userProductRepository
    ) {
    }

    public function handle(GetDetailListOfUserProductByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProductEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserProductEnum::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value,
                    $command
                )
            );

            $userProduct = Cache::tags([UserProductEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProductEnum::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userProductRepository->getByRelationshipUserSlug(
                    $command->userSlug,
                    ['userProductResources.contentType', 'user']
                )
            );

            return [
                'data' => UserProductResource::collection($userProduct),
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
