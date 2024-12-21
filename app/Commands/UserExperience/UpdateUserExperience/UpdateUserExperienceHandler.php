<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Enums\DefaultContentType;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
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
            $command->userSlug, $command->userExperienceId
        );

        if($userExperience)
        {
            DB::beginTransaction();

            try {
                $userExperience =  $this->userExperienceRepository->update([
                    'name' => $command->name,
                    'position' => $command->position,
                    'is_working' => $command->isWorking,
                    'start_date' => $command->startDate,
                    'end_date' => $command->endDate
                ], $command->userExperienceId);

                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();

                return null;
            }

            if(!empty($userExperience))
            {
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    $this->processAttachment($attachments, $userExperience->id);
                }
            }

            return $userExperience;
        }

        return null;
    }

    private function processAttachment($attachments, $userExperienceId): void
    {
        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_experience_resource_id']))
            {

            }else{
                $pathStorage = $this->userExperienceService->processStoreAttachment($attachment);

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
}
