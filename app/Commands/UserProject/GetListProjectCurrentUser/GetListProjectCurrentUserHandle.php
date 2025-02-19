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
            $user = auth()->user();

            $userProjects = $this->userRepository->findWithRelationships(
                $user->id,
                'userProjects.userProjectResources',
                [
                    'userProjects' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            return [
                'userProjects' => CurrentUserProjectResource::make($userProjects),
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
