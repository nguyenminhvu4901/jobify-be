<?php

namespace App\Commands\ProfileSeries\UserPrize\UpdateUserPrize;

use App\Http\Resources\ProfileSeries\UserPrize\UserPrizeResource;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use App\Services\ProfileSeries\UserPrize\UserPrizeService;

class UpdateUserPrizeHandle
{
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository,
        protected UserPrizeService $userPrizeService
    ) {
    }

    public function handle(UpdateUserPrizeCommand $command): array
    {
        try {
            $result = $this->userPrizeRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userPrizeId
            );

            if (! $result['success']) {
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {

                $this->userPrizeService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userPrizeResource: $result['data']->userPrizeResources,
                    userPrizeId: $command->userPrizeId
                );
            }

            return [
                'data' => UserPrizeResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(UpdateUserPrizeCommand $command): array
    {
        return [
            'name' => $command->name,
            'organization' => $command->organization,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
        ];
    }
}
