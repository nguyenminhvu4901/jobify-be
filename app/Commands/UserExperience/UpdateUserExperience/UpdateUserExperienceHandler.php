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
        $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userExperienceId, 'userExperienceResource'
        );

        if($userExperience)
        {
            return DB::transaction(function () use ($command) {
                $this->userExperienceRepository->update([
                    'name' => $command->name,
                    'position' => $command->position,
                    'is_working' => $command->isWorking,
                    'start_date' => $command->startDate,
                    'end_date' => $command->endDate
                ], $command->userExperienceId);

                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    $this->processAttachment($attachments, $command->userExperienceId);
                }else{

                }
            });
        }

        return null;
    }
}
