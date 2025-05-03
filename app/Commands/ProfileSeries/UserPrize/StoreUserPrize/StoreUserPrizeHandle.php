<?php

namespace App\Commands\ProfileSeries\UserPrize\StoreUserPrize;

use App\Http\Resources\ProfileSeries\UserPrize\UserPrizeResource;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use App\Services\ProfileSeries\UserPrize\UserPrizeService;

class StoreUserPrizeHandle
{
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository,
        protected UserPrizeService $userPrizeService
    ) {
    }

    public function handle(StoreUserPrizeCommand $command): array
    {
        try {
            $result = $this->userPrizeRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if (! $result['success']) {

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment) {
                    $pathStorage = $this->userPrizeService->saveAttachment($attachment);

                    if (! empty($pathStorage)) {

                        $this->userPrizeService->storeUserPrizeResource(
                            attachment: $attachment,
                            userPrizeId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
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

    private function prepareUserActivityData(StoreUserPrizeCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'organization' => $command->organization,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
        ];
    }
}
