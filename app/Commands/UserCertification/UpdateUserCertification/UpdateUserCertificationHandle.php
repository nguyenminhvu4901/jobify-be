<?php

namespace App\Commands\UserCertification\UpdateUserCertification;

use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Services\UserCertification\UserCertificationService;
use Illuminate\Support\Facades\DB;

class UpdateUserCertificationHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository,
        protected UserCertificationResourceRepository $userCertificationResourceRepository,
        protected UserCertificationService $userCertificationService
    )
    {
    }

    public function handle(UpdateUserCertificationCommand $command)
    {
        DB::beginTransaction();

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

            DB::commit();

            return $userCertification;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
