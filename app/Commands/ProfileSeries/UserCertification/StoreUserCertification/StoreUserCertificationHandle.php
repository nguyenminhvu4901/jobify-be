<?php

namespace App\Commands\ProfileSeries\UserCertification\StoreUserCertification;

use App\Http\Resources\ProfileSeries\UserCertification\UserCertificationResource;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepository;
use App\Services\ProfileSeries\UserCertification\UserCertificationService;

class StoreUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationService $userCertificationService
    ) {
    }

    public function handle(StoreUserCertificationCommand $command): array
    {
        try {
            $result = $this->userCertificationRepository->storeDataWithTransaction(
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
                    $pathStorage = $this->userCertificationService->saveAttachment($attachment);

                    if (! empty($pathStorage)) {
                        $this->userCertificationService->storeUserCertificationResource(
                            attachment: $attachment,
                            userCertificationId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            return [
                'data' => UserCertificationResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(StoreUserCertificationCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'organization' => $command->organization,
            'is_no_expiration' => $command->isNoExpiration,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
        ];
    }
}
