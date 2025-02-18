<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Http\Resources\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Services\UserExperience\UserExperienceService;

class StoreUserExperienceHandler
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
     * @param StoreUserExperienceCommand $command
     * @return array
     */
    public function handle(StoreUserExperienceCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userExperience = $this->userExperienceRepository->create([
                'user_id' => $userId,
                'name' => $command->name,
                'position' => $command->position,
                'is_working' => $command->isWorking,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate
            ]);

            if(!empty($command->attachments))
            {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment)
                {
                    $pathStorage = $this->userExperienceService->processSaveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userExperienceService->storeUserExperienceResource(
                            $attachment, $userExperience->id, $pathStorage
                        );
                    }
                }
            }

            if($userExperience){
                $userExperience->refresh();
            }

            return [
                'userExperience' => UserExperienceResource::make($userExperience),
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
