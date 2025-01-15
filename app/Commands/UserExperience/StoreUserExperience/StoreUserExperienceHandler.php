<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Enums\DefaultContentType;
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
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    /**
     * @param StoreUserExperienceCommand $command
     * @return mixed
     * @throws ValidatorException
     */
    public function handle(StoreUserExperienceCommand $command): mixed
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
                $this->userExperienceService->processAttachment($attachment, $userExperience->id);
            }
        }

        return $userExperience;
    }
}
