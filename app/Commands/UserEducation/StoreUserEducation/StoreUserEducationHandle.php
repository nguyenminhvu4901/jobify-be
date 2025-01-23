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

    public function handle(StoreUserEducationCommand $command)
    {
        $user = auth()->user();

        return $this->userEducationRepository->store([
            'user_id' => $user->id,
            'name' => $command->name,
            'major' => $command->major,
            'is_studying' => $command->isStudying,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description
        ]);
    }
}
