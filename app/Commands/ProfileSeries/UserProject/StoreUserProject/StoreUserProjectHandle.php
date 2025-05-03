<?php

namespace App\Commands\ProfileSeries\UserProject\StoreUserProject;

use App\Http\Resources\ProfileSeries\UserProject\UserProjectResource;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use App\Services\ProfileSeries\UserProject\UserProjectService;

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
            $result = $this->userProjectRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments))
            {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment)
                {
                    $pathStorage = $this->userProjectService->saveAttachment($attachment);

                    if(!empty($pathStorage)){

                        $this->userProjectService->storeUserProjectResource(
                            attachment: $attachment,
                            userProjectId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            return [
                'data' => UserProjectResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param StoreUserProjectCommand $command
     * @return array
     */
    private function prepareUserActivityData(StoreUserProjectCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
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
        ];
    }
}
