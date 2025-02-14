<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

class UpdateUserExperienceHandler
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     * @param UserExperienceResourceRepository $userExperienceResourceRepository
     * @param UserExperienceService $userExperienceService
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    /**
     * @param UpdateUserExperienceCommand $command
     * @return array
     * @throws ValidatorException
     */
    public function handle(UpdateUserExperienceCommand $command): array
    {
        $userExperience = $this->userExperienceRepository->updateUserExperience([
            'name' => $command->name,
            'position' => $command->position,
            'is_working' => $command->isWorking,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate
        ], $command->userExperienceId);

        if(!empty($command->attachments))
        {
            $attachments = $command->attachments;
            $userExperienceResource = $userExperience->userExperienceResource;

            $this->userExperienceService->updateResourceAttachment(
                $attachments, $userExperienceResource, $command->userExperienceId
            );
        }

        if(!empty($userExperience)) {

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
