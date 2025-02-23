<?php

namespace App\Commands\UserPrize\StoreUserPrize;

use App\Http\Resources\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;
use App\Services\UserPrize\UserPrizeService;

class StoreUserPrizeHandle
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
     * @param StoreUserPrizeCommand $command
     * @return array
     */
    public function handle(StoreUserPrizeCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userPrize = $this->userPrizeRepository->store([
                'user_id' => $userId,
                'name' => $command->name,
                'organization' => $command->organization,
                'start_date'=> $command->startDate,
                'end_date' => $command->endDate
            ]);

            if($userPrize){
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    foreach ($attachments as $attachment)
                    {
                        $pathStorage = $this->userPrizeService->saveAttachment($attachment);

                        if(!empty($pathStorage)){

                            $this->userPrizeService->storeUserPrizeResource(
                                attachment: $attachment,
                                userPrizeId: $userPrize->id,
                                pathStorage: $pathStorage
                            );
                        }
                    }
                }

                $userPrize->load(['userPrizeResources.contentType', 'user']);

                return [
                    'userPrize' => UserPrizeResource::make($userPrize),
                    'message' => __('messages.profile.user_update_profile_success')
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
