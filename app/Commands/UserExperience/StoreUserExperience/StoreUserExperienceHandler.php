<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;

class StoreUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {}

    public function handle(StoreUserExperienceCommand $command)
    {
        $userId = auth()->user()->id;

        return $this->userExperienceRepository->create([
            'user_id' => $userId,
            'name' => $command->name,
            'position' => $command->position,
            'is_working' => $command->isWorking,
            'start_date'=> $command->startDate,
            'end_date' => $command->endDate
        ]);
    }
}
