<?php

namespace App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Http\Resources\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;

class DetailListOfUserExperienceByUserSlugHandle
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    /**
     * @param DetailListOfUserExperienceByUserSlugCommand $command
     * @return array
     */
    public function handle(DetailListOfUserExperienceByUserSlugCommand $command): array
    {
        try {
            $userExperiences = $this->userExperienceRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userExperienceResource', 'user']
            );

            return [
                'userExperiences' => UserExperienceResource::collection($userExperiences),
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
