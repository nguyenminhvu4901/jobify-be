<?php

namespace App\Commands\UserProject\StoreUserProject;

use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProject\UserProjectRepository;
use App\Services\UserProject\UserProjectService;

class StoreUserProjectHandle
{
    /**
     * @param UserProjectRepository $userProjectRepository
     * @param UserProjectService $userProjectService
     */
    public function __construct(
        protected UserProjectRepository $userProjectRepository,
        protected UserProjectService $userProjectService
    )
    {
    }

    /**
     * @param StoreUserProjectCommand $command
     * @return array
     */
    public function handle(StoreUserProjectCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userProject = $this->userProjectRepository->store([
                'user_id' => $userId,
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
            ]);

            if($userProject){
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    foreach ($attachments as $attachment)
                    {
                        $pathStorage = $this->userProjectService->saveAttachment($attachment);

                        if(!empty($pathStorage)){

                            $this->userProjectService->storeUserProjectResource(
                                attachment: $attachment,
                                userProjectId: $userProject->id,
                                pathStorage: $pathStorage
                            );
                        }
                    }
                }

                $userProject->load(['userProjectResources.contentType', 'user']);

                return [
                    'userProject' => UserProjectResource::make($userProject),
                    'message' => __('messages.profile.user_update_profile_success')
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
