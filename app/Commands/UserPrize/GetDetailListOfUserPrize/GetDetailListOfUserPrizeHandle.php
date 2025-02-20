<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrize;

use App\Http\Resources\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;

class GetDetailListOfUserPrizeHandle
{
    /**
     * @param UserPrizeRepository $userPrizeRepository
     */
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserPrizeCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserPrizeCommand $command): array
    {
        try {
            $userPrize = $this->userPrizeRepository->findWithRelationships(
                $command->userPrizeId,
                ['user', 'userPrizeResources']
            );

            return [
                'userPrize' => UserPrizeResource::make($userPrize),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
