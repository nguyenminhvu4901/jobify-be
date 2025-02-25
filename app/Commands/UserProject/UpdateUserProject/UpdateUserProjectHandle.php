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

            if($userProject){
                if(!empty($command->attachments)){

                    $this->userProjectService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userProjectResource: $userProject->userProjectResources,
                        userProjectId: $command->userProjectId
                    );
                }

                $userProject->load(['userProjectResources.contentType', 'user']);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userProject' => UserProjectResource::make($userProject)
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
