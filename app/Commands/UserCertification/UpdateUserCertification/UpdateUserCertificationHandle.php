<?php

namespace App\Commands\UserCertification\UpdateUserCertification;

use App\Http\Resources\UserCertification\UserCertificationResource;
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
            $userCertification = $this->userCertificationRepository->updateUserCertification([
                'name' => $command->name,
                'organization' => $command->organization,
                'is_no_expiration' => $command->isNoExpiration,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate
            ], $command->userCertificationId);

            if($userCertification){
                if(!empty($command->attachments)){

                    $this->userCertificationService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userCertificationResource: $userCertification?->userCertificationResources,
                        userCertificationId: $command->userCertificationId
                    );
                }

                $userCertification->load([
                    'user', 'userCertificationResources.contentType'
                ]);

                return [
                    'userCertification' => UserCertificationResource::make($userCertification),
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
