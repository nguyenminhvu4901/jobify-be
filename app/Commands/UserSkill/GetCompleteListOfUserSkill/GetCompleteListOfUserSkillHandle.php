<?php

namespace App\Commands\UserSkill\GetCompleteListOfUserSkill;

use App\Http\Resources\UserSkill\UserSkillResource;
use App\Repositories\UserSkill\UserSkillRepository;

class GetCompleteListOfUserSkillHandle
{
    /**
     * @param UserSkillRepository $userSkillRepository
     */
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $userSkills = $this->userSkillRepository->getWithRelationship(['user', 'rate']);

            return [
                'data' => UserSkillResource::collection($userSkills),
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
