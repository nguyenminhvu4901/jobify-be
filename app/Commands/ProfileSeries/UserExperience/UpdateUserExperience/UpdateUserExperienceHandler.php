<?php

namespace App\Commands\ProfileSeries\UserExperience\UpdateUserExperience;

use App\Http\Resources\ProfileSeries\UserExperience\UserExperienceResource;
use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepository;
use App\Services\UserExperience\UserExperienceService;

class UpdateUserExperienceHandler
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     * @param UserExperienceService $userExperienceService
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    /**
     * @param UpdateUserExperienceCommand $command
     * @return array
     */
    public function handle(UpdateUserExperienceCommand $command): array
    {
        try {
            $result = $this->userExperienceRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command), $command->userExperienceId);

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments))
            {
                $this->userExperienceService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userExperienceResource: $result['data']->userExperienceResource,
                    userExperienceId: $command->userExperienceId
                );
            }

            $result['data']->load([
                'user', 'userExperienceResource.contentType'
            ]);

            return [
                'data' => UserExperienceResource::make($result['data']),
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
     * @param UpdateUserExperienceCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserExperienceCommand $command): array
    {
        return [
            'name' => $command->name,
            'position' => $command->position,
            'is_working' => $command->isWorking,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate
        ];
    }
}
