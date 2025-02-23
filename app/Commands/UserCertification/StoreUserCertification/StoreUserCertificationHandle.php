<?php

namespace App\Commands\UserCertification\StoreUserCertification;

use App\Http\Resources\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use App\Services\UserCertification\UserCertificationService;

class StoreUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     * @param UserCertificationService $userCertificationService
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationService $userCertificationService
    )
    {}

    /**
     * @param StoreUserCertificationCommand $command
     * @return array
     */
    public function handle(StoreUserCertificationCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userCertification = $this->userCertificationRepository->create([
                'user_id' => $userId,
                'name' => $command->name,
                'organization' => $command->organization,
                'is_no_expiration' => $command->isNoExpiration,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate
            ]);

            if($userCertification){
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    foreach ($attachments as $attachment)
                    {
                        $pathStorage = $this->userCertificationService->saveAttachment($attachment);

                        if(!empty($pathStorage)){
                            $this->userCertificationService->storeUserCertificationResource(
                                attachment: $attachment,
                                userCertificationId: $userCertification->id,
                                pathStorage: $pathStorage
                            );
                        }
                    }
                }

                $userCertification->load([
                    'user', 'userCertificationResources.contentType'
                ]);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userCertification' => UserCertificationResource::make($userCertification)
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error'),
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
