<?php

namespace App\Commands\UserSkill\UpdateUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;

class UpdateUserSkillHandle
{
    /**
     * @param UserSkillRepository $userSkillRepository
     */
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    ){}

    /**
     * @param UpdateUserSkillCommand $command
     * @return array
     */
    public function handle(UpdateUserSkillCommand $command): array
    {
        $userSkill = $this->userSkillRepository->updateUserSkill([
            'name' => $command->name,
            'rate_id' => $command->rateId,
            'description' => $command->description
        ], $command->userSkillId);

        if(!empty($userSkill)){
            return [
                'userSkill' => $userSkill,
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_update_profile_error')
        ];
    }
}
