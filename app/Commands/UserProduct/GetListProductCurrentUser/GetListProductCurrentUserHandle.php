<?php

namespace App\Commands\UserProduct\GetListProductCurrentUser;

use App\Http\Resources\UserProduct\CurrentUserProductResource;
use App\Repositories\User\UserRepository;

class GetListProductCurrentUserHandle
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
            $userProducts = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userProducts.userProductResources.contentType',
                [
                    'userProducts' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userProducts)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserProductResource::make($userProducts),
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
