<?php

namespace App\Commands\UserProject\GetDetailListOfUserProject;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;

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
            $userProject = $this->userProjectRepository->findWithRelationships(
                $command->userProjectId,
                ['user', 'userProjectResources.contentType']
            );

            if(empty($userProject)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserProjectResource::make($userProject),
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
