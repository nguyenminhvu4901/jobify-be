<?php

namespace App\Commands\ProfileSeries\UserProject\GetCompleteListOfUserProject;

use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserProject\UserProjectResource;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserProjectHandle
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
     * @param GetCompleteListOfUserProjectCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserProjectCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProjectEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserProjectEnum::COMPLETE_LIST_USER_PROJECT->value,
                        $command
                    )
                );

            $userProjects = Cache::tags([UserProjectEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProjectEnum::COMPLETE_LIST_USER_PROJECT->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userProjectRepository->cursorPaginateWithRelationship(
                    relationship: ['userProjectResources.contentType', 'user'],
                    limit:  $command->limit
                )
            );

            return [
                'data' => UserProjectResource::collection($userProjects),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatCursorPaginationData($userProjects ?? [])
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
