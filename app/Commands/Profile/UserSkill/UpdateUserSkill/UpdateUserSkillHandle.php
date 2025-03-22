<?php

namespace App\Commands\Profile\UserSkill\UpdateUserSkill;

use App\Http\Resources\Profile\UserSkill\UserSkillResource;
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
            $result = $this->userSkillRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command), $command->userSkillId
            );

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            $result['data']->load(['user', 'rate']);

            return [
                'data' => UserSkillResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
    /**
     * @param UpdateUserSkillCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserSkillCommand $command): array
    {
        return [
            'name' => $command->name,
            'rate_id' => $command->rateId,
            'description' => $command->description
        ];
    }
}
