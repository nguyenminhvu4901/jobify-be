<?php

namespace App\Commands\UserProject\GetCompleteListOfUserProject;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;

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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userProjects = $this->userProjectRepository->getWithRelationship(
                ['userProjectResources.contentType', 'user']
            );

            return [
                'data' => UserProjectResource::collection($userProjects),
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
