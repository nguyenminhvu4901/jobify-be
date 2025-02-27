<?php

namespace App\Commands\UserPrize\GetListPrizeCurrentUser;

use App\Http\Resources\UserPrize\CurrentUserPrizeResource;
use App\Repositories\User\UserRepository;

class GetListPrizeCurrentUserHandle
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $userPrizes = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userPrizes.userPrizeResources.contentType',
                [
                    'userPrizes' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userPrizes)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserPrizeResource::make($userPrizes),
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
