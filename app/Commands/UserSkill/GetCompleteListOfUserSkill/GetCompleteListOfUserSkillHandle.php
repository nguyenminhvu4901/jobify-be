<?php

namespace App\Commands\UserSkill\GetCompleteListOfUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;

class GetCompleteListOfUserSkillHandle
{
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
        $userSkills = $this->userSkillRepository->getWithRelationship(['user', 'rate']);

        if($userSkills->isNotEmpty()){
            return [
                'userSkills' => $userSkills,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
