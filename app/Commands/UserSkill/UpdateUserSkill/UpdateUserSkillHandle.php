<?php

namespace App\Commands\UserSkill\UpdateUserSkill;

use App\Http\Resources\UserSkill\UserSkillResource;
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
        try {
            $userSkill = $this->userSkillRepository->updateUserSkill([
                'name' => $command->name,
                'rate_id' => $command->rateId,
                'description' => $command->description
            ], $command->userSkillId);

            return [
                'userSkill' => UserSkillResource::make($userSkill),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
