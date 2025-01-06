<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use Illuminate\Support\Facades\DB;

class UpdateUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(UpdateUserExperienceCommand $command)
    {
        $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userExperienceId
        );

        if($userExperience)
        {
            return DB::transaction(function () use ($command) {
                return $this->userExperienceRepository->update([
                    'name' => $command->name,
                    'position' => $command->position,
                    'is_working' => $command->isWorking,
                    'start_date' => $command->startDate,
                    'end_date' => $command->endDate
                ], $command->userExperienceId);
            });
        }

        return null;
    }
}
