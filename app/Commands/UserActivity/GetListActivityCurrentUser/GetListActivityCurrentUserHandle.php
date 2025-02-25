<?php

namespace App\Commands\UserActivity\GetListActivityCurrentUser;

use App\Http\Resources\UserActivity\CurrentUserActivityResource;
use App\Repositories\User\UserRepository;

class GetListActivityCurrentUserHandle
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
            $userActivities = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userActivities.userActivityResources.contentType',
                [
                    'userProducts' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userActivities)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserActivityResource::make($userActivities),
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
