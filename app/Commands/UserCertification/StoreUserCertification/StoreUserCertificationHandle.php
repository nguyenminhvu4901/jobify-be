<?php

namespace App\Commands\UserCertification\StoreUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;
use App\Services\UserCertification\UserCertificationService;
use Prettus\Validator\Exceptions\ValidatorException;

class StoreUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationService $userCertificationService
    )
    {}

    /**
     * @param StoreUserCertificationCommand $command
     * @return mixed
     * @throws ValidatorException
     */
    public function handle(StoreUserCertificationCommand $command): mixed
    {
        $userId = auth()->user()->id;

        $userCertification = $this->userCertificationRepository->create([
            'user_id' => $userId,
            'name' => $command->name,
            'organization' => $command->organization,
            'is_no_expiration' => $command->isNoExpiration,
            'start_date'=> $command->startDate,
            'end_date' => $command->endDate
        ]);

        if(!empty($command->attachments))
        {
            $attachments = $command->attachments;

            foreach ($attachments as $attachment)
            {
                $pathStorage = $this->userCertificationService->processSaveAttachment($attachment);

                if(!empty($pathStorage)){
                    $this->userCertificationService->storeUserCertificationResource(
                        $attachment, $userCertification->id, $pathStorage
                    );
                }
            }
        }

        return $userCertification;
    }
}
