<?php

namespace App\Commands\UserEducation\UpdateUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class UpdateUserEducationHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @param UpdateUserEducationCommand $command
     * @return array
     */
    public function handle(UpdateUserEducationCommand $command): array
    {
        $userEducation = $this->userEducationRepository->updateUserEducation([
                'name' => $command->name,
                'major' => $command->major,
                'is_studying' => $command->isStudying,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description
        ], $command->userEducationId);

        if(!empty($userEducation)){
            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userEducation' => $userEducation
            ];
        }

        return [
            'message' => __('messages.profile.user_update_profile_error')
        ];
    }
}
