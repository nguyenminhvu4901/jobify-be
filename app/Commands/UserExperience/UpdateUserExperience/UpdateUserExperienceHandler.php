<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;
use Illuminate\Support\Facades\DB;

class UpdateUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    public function handle(UpdateUserExperienceCommand $command)
    {
        DB::beginTransaction();

        try {
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

                $this->userExperienceService->processUpdateAttachment(
                    $attachments, $userExperienceResource, $command->userExperienceId
                );
            }

            DB::commit();

            return $userExperience;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
