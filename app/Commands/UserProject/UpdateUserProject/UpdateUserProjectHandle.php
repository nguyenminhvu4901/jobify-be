<?php

namespace App\Commands\UserProject\UpdateUserProject;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;
use App\Services\UserProject\UserProjectService;

class UpdateUserProjectHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository,
        protected UserProjectService $userProjectService
    )
    {
    }

    public function handle(UpdateUserProjectCommand $command): array
    {
        try {
            $userProject = $this->userProjectRepository->updateUserProject([
                'name' => $command->name,
                'client' => $command->client,
                'member' => $command->member,
                'position' => $command->position,
                'mission' => $command->mission,
                'technology' => $command->technology,
                'is_working' => $command->isWorking,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description
            ], $command->userProjectId);

            if(!empty($command->attachments)){

                $attachments = $command->attachments;
                $userProjectResource = $userProject->userProjectResources;

                $this->userProjectService->updateResourceAttachment(
                    attachments: $attachments,
                    userProjectResource: $userProjectResource,
                    userProjectId: $command->userProjectId
                );
            }

            if ($userProject) {
                $userProject->refresh();
            }

            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userProject' => UserProjectResource::make($userProject)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
