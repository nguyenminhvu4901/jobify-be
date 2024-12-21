<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Enums\DefaultContentType;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Prettus\Validator\Exceptions\ValidatorException;

class StoreUserExperienceHandler
{
    use ImageHandler, VideoHandler;

    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository
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

            $this->processAttachment($attachments, $userExperience->id);
        }

        return $userExperience;
    }

    /**
     * @param $attachments
     * @param $userExperienceId
     * @return void
     * @throws ValidatorException
     */
    private function processAttachment($attachments, $userExperienceId): void
    {
        $user = auth()->user();

        foreach ($attachments as $attachment) {
            if($attachment['content_type_id'] == DefaultContentType::IMAGE->value)
            {
                $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/experiences';
                $pathStorage = $this->storeImage($attachment['content'], $path, $user);

            }elseif($attachment['content_type_id'] == DefaultContentType::URL->value)
            {
                $pathStorage = $attachment['content'];

            }elseif ($attachment['content_type_id'] == DefaultContentType::VIDEO->value)
            {
                $path = 'videos/profiles/' . extractEmailPrefix($user->email) . '/experiences';
                $pathStorage = $this->storeVideo($attachment['content'], $path, $user);

            }else{
                continue;
            }

            if(!empty($pathStorage))
            {
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
}
