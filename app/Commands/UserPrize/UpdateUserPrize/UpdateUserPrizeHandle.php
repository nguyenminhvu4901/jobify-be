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

            if($userPrize){
                if(!empty($command->attachments)){

                    $this->userPrizeService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userPrizeResource: $userPrize->userPrizeResources,
                        userPrizeId: $command->userPrizeId
                    );
                }

                $userPrize->load(['userPrizeResources.contentType', 'user']);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userPrize' => UserPrizeResource::make($userPrize)
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
