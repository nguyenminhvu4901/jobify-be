<?php

namespace App\Commands\ProfileSeries\UserProject\GetDetailListOfUserProjectByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProject;
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
            $cache = Cache::tags([UserProject::TAG_NAME->value])->has(
                generateCacheName(
                    UserProject::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value,
                    $command
                ));

            $userProject = Cache::tags([UserProject::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProject::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value,
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
