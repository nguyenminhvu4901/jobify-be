<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Traits\ImageHandler;
use Prettus\Validator\Exceptions\ValidatorException;

class StoreUserExperienceHandler
{
    use ImageHandler;

    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository
    )
    {
    }

    /**
     * @param StoreUserExperienceCommand $command
     * @return mixed
     */
    public function handle(StoreUserExperienceCommand $command)
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

            $this->saveAttachment($attachments, $userExperience->id);
        }

        return $userExperience;
    }

    /**
     * @param $attachments
     * @param $userExperienceId
     * @return void
     * @throws ValidatorException
     */
    private function saveAttachment($attachments, $userExperienceId): void
    {
        $user = auth()->user();

        $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/experiences';

        foreach ($attachments as $attachment) {
            $pathStorage = $this->storeImage($attachment['file'], $path, $user);

            $this->userExperienceResourceRepository->create([
                'user_experience_id' => $userExperienceId,
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ]);
        }
    }
}
