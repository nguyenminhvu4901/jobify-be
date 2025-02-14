<?php

namespace App\Commands\UserSkill\StoreUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;

class StoreUserSkillHandle
{
    /**
     * @param UserSkillRepository $userSkillRepository
     */
    public function __construct(
        protected UserSkillRepository $userSkillRepository)
    {
    }

    /**
     * @param StoreUserSkillCommand $command
     * @return array
     */
    public function handle(StoreUserSkillCommand $command): array
    {
        $userId = auth()->user()->id;

        $userSkill = $this->userSkillRepository->create([
            'user_id' => $userId,
            'name' => $command->name,
            'rate_id' => $command->rateId,
            'description' => $command->description
        ]);

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
