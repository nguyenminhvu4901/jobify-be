<?php

namespace App\Commands\UserExperience\GetCompleteListOfUserExperience;

use App\Http\Resources\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;

class GetCompleteListOfUserExperienceHandler
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userExperiences = $this->userExperienceRepository->getWithRelationship(
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
