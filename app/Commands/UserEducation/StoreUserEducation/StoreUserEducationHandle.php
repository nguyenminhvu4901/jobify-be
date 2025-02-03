<?php

namespace App\Commands\UserEducation\StoreUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;

class StoreUserEducationHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    public function handle(StoreUserEducationCommand $command): array
    {
        $userId = auth()->user()->id;

        $userEducation =  $this->userEducationRepository->store([
            'user_id' => $userId,
            'name' => $command->name,
            'major' => $command->major,
            'is_studying' => $command->isStudying,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description
        ]);

        if(!empty($userEducation)){
            return [
                'message' => __('messages.user_update_profile_success'),
                'userEducation' => $userEducation
            ];
        }

        return [
            'message' => __('messages.user_update_profile_error')
        ];
    }
}
