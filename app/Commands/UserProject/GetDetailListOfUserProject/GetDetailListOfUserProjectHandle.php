<?php

namespace App\Commands\UserProject\GetDetailListOfUserProject;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProject;
use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserProjectHandle
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
     * @param GetDetailListOfUserProjectCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserProjectCommand $command): array
    {
        try {
            $cache = Cache::tags([UserProject::TAG_NAME->value])->has(
                generateCacheName(
                    UserProject::DETAIL_LIST_USER_PROJECT->value,
                    $command
                )
            );

            $userProject = Cache::tags([UserProject::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserProject::DETAIL_LIST_USER_PROJECT->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userProjectRepository->findWithRelationships(
                        $command->userProjectId,
                        ['user', 'userProjectResources.contentType']
                    )
                );

            if(empty($userProject)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserProjectResource::make($userProject),
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
