<?php

namespace App\Commands\UserProject\GetCompleteListOfUserProject;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProject;
use App\Helpers\Global\PaginationHelper;
use App\Http\Resources\Profile\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;
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
            $cache = Cache::tags([UserProject::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserProject::COMPLETE_LIST_USER_PROJECT->value,
                        $command
                    )
                );

            $userProjects = Cache::tags([UserProject::TAG_NAME->value])->remember(
                generateCacheName(
                    UserProject::COMPLETE_LIST_USER_PROJECT->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userProjectRepository->paginateWithRelationship(
                    relationship: ['userProjectResources.contentType', 'user'],
                    limit:  $command->limit
                )
            );

            return [
                'data' => UserProjectResource::collection($userProjects),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => PaginationHelper::formatPaginationData($userProjects) ?? []
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
