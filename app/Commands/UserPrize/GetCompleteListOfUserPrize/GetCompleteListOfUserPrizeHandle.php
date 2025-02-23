<?php

namespace App\Commands\UserPrize\GetCompleteListOfUserPrize;

use App\Http\Resources\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;

class GetCompleteListOfUserPrizeHandle
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userPrizes = $this->userPrizeRepository->getWithRelationship(
                ['userPrizeResources.contentType', 'user']
            );

            return [
                'userPrizes' => UserPrizeResource::collection($userPrizes),
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
