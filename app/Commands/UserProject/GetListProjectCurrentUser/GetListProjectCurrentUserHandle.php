<?php

namespace App\Commands\UserProject\GetListProjectCurrentUser;

use App\Http\Resources\UserProject\CurrentUserProjectResource;
use App\Repositories\User\UserRepository;

class GetListProjectCurrentUserHandle
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
            $userProjects = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userProjects.userProjectResources.contentType',
                [
                    'userProjects' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userProjects)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserProjectResource::make($userProjects),
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
