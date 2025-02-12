<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Prettus\Validator\Exceptions\ValidatorException;

class StoreUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    /**
     * @param StoreUserExperienceCommand $command
     * @return array
     * @throws ValidatorException
     */
    public function handle(StoreUserExperienceCommand $command): array
    {
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

        if(!empty($userExperience)){
            return [
                'userExperience' => $userExperience,
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_update_profile_error')
        ];
    }
}
