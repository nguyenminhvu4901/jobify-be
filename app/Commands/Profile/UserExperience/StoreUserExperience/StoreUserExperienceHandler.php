<?php

namespace App\Commands\Profile\UserExperience\StoreUserExperience;

use App\Http\Resources\Profile\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Services\UserExperience\UserExperienceService;

class StoreUserExperienceHandler
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     * @param UserExperienceService $userExperienceService
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    /**
     * @param StoreUserExperienceCommand $command
     * @return array
     */
    public function handle(StoreUserExperienceCommand $command): array
    {
        try {
            $result = $this->userExperienceRepository->storeDataWithTransaction(
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
                    $pathStorage = $this->userExperienceService->saveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userExperienceService->storeUserExperienceResource(
                            attachment: $attachment,
                            userExperienceId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            $result['data']->load([
                'user', 'userExperienceResource.contentType'
            ]);

            return [
                'data' => UserExperienceResource::make($result['data']),
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
     * @param StoreUserExperienceCommand $command
     * @return array
     */
    private function prepareUserActivityData(StoreUserExperienceCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'position' => $command->position,
            'is_working' => $command->isWorking,
            'start_date'=> $command->startDate,
            'end_date' => $command->endDate
        ];
    }
}
