<?php

namespace App\Commands\UserExperience\DetailListOfUserExperience;

use App\Http\Resources\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;

class DetailListOfUserExperienceHandle
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(DetailListOfUserExperienceCommand $command): array
    {
        try {
            $userExperience = $this->userExperienceRepository->findWithRelationships(
                $command->userExperienceId,
                ['user', 'userExperienceResource.contentType']
            );

            return [
                'userExperience' => UserExperienceResource::make($userExperience),
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
