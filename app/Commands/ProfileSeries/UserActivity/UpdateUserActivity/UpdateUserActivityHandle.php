<?php

namespace App\Commands\ProfileSeries\UserActivity\UpdateUserActivity;

use App\Http\Resources\ProfileSeries\UserActivity\UserActivityResource;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepository;
use App\Services\ProfileSeries\UserActivity\UserActivityService;

class UpdateUserActivityHandle
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
     * @param UpdateUserActivityCommand $command
     * @return array
     */
    public function handle(UpdateUserActivityCommand $command): array
    {
        try {
            $result = $this->userActivityRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userActivityId
            );

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments)){

                $this->userActivityService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userActivityResource: $result['data']->userActivityResources,
                    userActivityId: $command->userActivityId
                );
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
     * @param UpdateUserActivityCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserActivityCommand $command): array
    {
        return [
            'name' => $command->name,
            'position' => $command->position,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description,
        ];
    }
}
