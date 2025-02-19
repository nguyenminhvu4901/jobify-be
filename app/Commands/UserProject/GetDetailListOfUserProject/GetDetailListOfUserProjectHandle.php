<?php

namespace App\Commands\UserProject\GetDetailListOfUserProject;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;

class GetDetailListOfUserProjectHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository
    )
    {
    }

    public function handle(GetDetailListOfUserProjectCommand $command): array
    {
        try {
            $userProject = $this->userProjectRepository->findWithRelationships(
                $command->userProjectId,
                ['user', 'userProjectResources']
            );

            return [
                'userProject' => UserProjectResource::make($userProject),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
