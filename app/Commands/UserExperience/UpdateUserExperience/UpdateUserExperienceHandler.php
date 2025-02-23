<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Http\Resources\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;
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
            $userExperience = $this->userExperienceRepository->updateUserExperience([
                'name' => $command->name,
                'position' => $command->position,
                'is_working' => $command->isWorking,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate
            ], $command->userExperienceId);

            if($userExperience){
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;
                    $userExperienceResource = $userExperience->userExperienceResource;

                    $this->userExperienceService->updateResourceAttachment(
                        attachments: $attachments,
                        userExperienceResource: $userExperienceResource,
                        userExperienceId: $command->userExperienceId
                    );
                }

                $userExperience->load([
                    'user', 'userExperienceResource.contentType'
                ]);

                return [
                    'userExperience' => UserExperienceResource::make($userExperience),
                    'message' => __('messages.profile.user_update_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
