<?php

namespace App\Commands\UserCertification\UpdateUserCertification;

use App\Http\Resources\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
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

            if(!empty($command->attachments)){
                $attachments = $command->attachments;
                $userCertificationResource = $userCertification->userCertificationResources;

                $this->userCertificationService->updateResourceAttachment(
                    $attachments, $userCertificationResource, $command->userCertificationId
                );
            }

            if($userCertification){
                $userCertification->refresh();
            }

            return [
                'userCertification' => UserCertificationResource::make($userCertification),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
