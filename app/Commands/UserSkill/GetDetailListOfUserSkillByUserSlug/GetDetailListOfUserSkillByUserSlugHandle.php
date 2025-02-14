<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkillByUserSlug;

use App\Repositories\UserSkill\UserSkillRepository;

class GetDetailListOfUserSkillByUserSlugHandle
{
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserSkillByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserSkillByUserSlugCommand $command): array
    {
        $userSkills = $this->userSkillRepository->getByRelationshipUserSlug(
            $command->userSlug,
            ['user', 'rate']
        );

        if(!empty($userSkills)){
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
