<?php

namespace App\Commands\UserProject\GetDetailListOfUserProjectByUserSlug;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;

class GetDetailListOfUserProjectByUserSlugHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository
    )
    {
    }

    public function handle(GetDetailListOfUserProjectByUserSlugCommand $command): array
    {
        try {
            $userProject = $this->userProjectRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userProjectResources.contentType', 'user']
            );

            return [
                'userProject' => UserProjectResource::collection($userProject),
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
