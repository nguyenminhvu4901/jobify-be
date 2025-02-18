<?php

namespace App\Commands\UserSkill\StoreUserSkill;

use App\Http\Resources\UserSkill\UserSkillResource;
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
        try {
            $userId = auth()->user()->id;

            $userSkill = $this->userSkillRepository->create([
                'user_id' => $userId,
                'name' => $command->name,
                'rate_id' => $command->rateId,
                'description' => $command->description
            ]);

            if($userSkill){
                $userSkill->refresh();
            }

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
