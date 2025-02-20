<?php

namespace App\Commands\UserPrize\UpdateUserPrize;

use App\Http\Resources\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;
use App\Services\UserPrize\UserPrizeService;

class UpdateUserPrizeHandle
{
    /**
     * @param UserPrizeRepository $userPrizeRepository
     * @param UserPrizeService $userPrizeService
     */
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository,
        protected UserPrizeService $userPrizeService
    )
    {
    }

    /**
     * @param UpdateUserPrizeCommand $command
     * @return array
     */
    public function handle(UpdateUserPrizeCommand $command): array
    {
        try {
            $userPrize = $this->userPrizeRepository->updateUserPrize([
                'name' => $command->name,
                'organization' => $command->organization,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate
            ], $command->userPrizeId);

            if(!empty($command->attachments)){

                $attachments = $command->attachments;
                $userPrizeResource = $userPrize->userPrizeResources;

                $this->userPrizeService->updateResourceAttachment(
                    attachments: $attachments,
                    userPrizeResource: $userPrizeResource,
                    userPrizeId: $command->userPrizeId
                );
            }

            if ($userPrize) {
                $userPrize->refresh();
            }

            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userPrize' => UserPrizeResource::make($userPrize)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
