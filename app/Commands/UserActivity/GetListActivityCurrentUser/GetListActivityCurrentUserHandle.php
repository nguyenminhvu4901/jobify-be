<?php

namespace App\Commands\UserActivity\GetListActivityCurrentUser;

use App\Http\Resources\UserActivity\CurrentUserActivityResource;
use App\Http\Resources\UserProduct\CurrentUserProductResource;
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
            $user = auth()->user();

            $userActivities = $this->userRepository->findWithRelationships(
                $user->id,
                'userActivities.userActivityResources.contentType',
                [
                    'userProducts' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            return [
                'userActivities' => CurrentUserActivityResource::make($userActivities),
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
