<?php

namespace App\Commands\UserCertification\StoreUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\UserCertification\UserCertificationService;

class StoreUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationService $userCertificationService,
        protected UserCertificationResourceRepository $userCertificationResourceRepository
    )
    {}

    /**
     * @param StoreUserCertificationCommand $command
     * @return mixed
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
                $pathStorage = $this->userCertificationService->processAttachment($attachment);

                if(!empty($pathStorage)){
                    $this->userCertificationResourceRepository->create([
                        'user_certification_id' => $userCertification->id,
                        'title' => $attachment['title'],
                        'path' => $pathStorage,
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id']
                    ]);
                }
            }
        }

        return $userCertification;
    }
}
