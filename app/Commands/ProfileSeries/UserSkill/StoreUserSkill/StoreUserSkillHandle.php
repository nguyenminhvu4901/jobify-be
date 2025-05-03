<?php

namespace App\Commands\ProfileSeries\UserSkill\StoreUserSkill;

use App\Http\Resources\ProfileSeries\UserSkill\UserSkillResource;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;

class StoreUserSkillHandle
{
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    ) {
    }

    public function handle(StoreUserSkillCommand $command): array
    {
        try {
            $result = $this->userSkillRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if (! $result['success']) {

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            return [
                'data' => UserSkillResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(StoreUserSkillCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'rate_id' => $command->rateId,
            'description' => $command->description,
        ];
    }
}
