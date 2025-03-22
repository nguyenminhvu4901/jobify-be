<?php

namespace App\Commands\Profile\UserCertification\UpdateUserCertification;

use App\Http\Resources\Profile\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use App\Services\UserCertification\UserCertificationService;

class UpdateUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     * @param UserCertificationService $userCertificationService
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationService $userCertificationService
    )
    {
    }

    /**
     * @param UpdateUserCertificationCommand $command
     * @return array
     */
    public function handle(UpdateUserCertificationCommand $command): array
    {
        try {
            $result = $this->userCertificationRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userCertificationId
            );

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments)){

                $this->userCertificationService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userCertificationResource: $result['data']->userCertificationResources,
                    userCertificationId: $command->userCertificationId
                );

            }

            $result['data']->load([
                'user', 'userCertificationResources.contentType'
            ]);

            return [
                'data' => UserCertificationResource::make($result['data']),
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
     * @param UpdateUserCertificationCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserCertificationCommand $command): array
    {
        return [
            'name' => $command->name,
            'organization' => $command->organization,
            'is_no_expiration' => $command->isNoExpiration,
            'start_date'=> $command->startDate,
            'end_date' => $command->endDate
        ];
    }
}
