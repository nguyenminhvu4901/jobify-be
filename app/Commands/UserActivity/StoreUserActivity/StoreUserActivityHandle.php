<?php

namespace App\Commands\UserActivity\StoreUserActivity;

use App\Http\Resources\Profile\UserActivity\UserActivityResource;
use App\Repositories\UserActivity\UserActivityRepository;
use App\Services\UserActivity\UserActivityService;

class StoreUserActivityHandle
{
    /**
     * @param UserActivityRepository $userActivityRepository
     * @param UserActivityService $userActivityService
     */
    public function __construct(
        protected UserActivityRepository $userActivityRepository,
        protected UserActivityService $userActivityService
    )
    {
    }

    /**
     * @param StoreUserActivityCommand $command
     * @return array
     */
    public function handle(StoreUserActivityCommand $command): array
    {
        try {
            $result = $this->userActivityRepository->storeDataWithTransaction(
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
                    $pathStorage = $this->userActivityService->saveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userActivityService->storeUserActivityResource(
                            attachment: $attachment,
                            userActivityId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            $result['data']->load(['userActivityResources.contentType', 'user']);

            return [
                'data' => UserActivityResource::make($result['data']),
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
     * @param StoreUserActivityCommand $command
     * @return array
     */
    private function prepareUserActivityData(StoreUserActivityCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'position' => $command->position,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description,
        ];
    }
}
