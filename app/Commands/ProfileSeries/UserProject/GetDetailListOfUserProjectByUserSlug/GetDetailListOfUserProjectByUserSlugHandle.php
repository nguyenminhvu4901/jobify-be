<?php

namespace App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProjectByUserSlug;

use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserProject\UserProjectResource;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserProjectByUserSlugHandle
{
    /**
     * @param UserProjectRepository $userProjectRepository
     */
    public function __construct(
        protected UserProjectRepository $userProjectRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserProjectByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserProjectByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProjectEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserProjectEnum::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value,
                    $command
                ));

            $userProject = Cache::tags([UserProjectEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProjectEnum::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userProjectRepository->getByRelationshipUserSlug(
                    $command->userSlug,
                    ['userProjectResources.contentType', 'user']
                )
            );

            return [
                'data' => UserProjectResource::collection($userProject),
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
