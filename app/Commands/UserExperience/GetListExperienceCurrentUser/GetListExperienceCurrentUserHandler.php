<?php

namespace App\Commands\UserExperience\GetListExperienceCurrentUser;

use App\Repositories\User\UserRepository;

class GetListExperienceCurrentUserHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle()
    {
        $user = auth()->user();

        $userExperience = $this->userRepository->findWithRelationships(
            $user->id,
            'userExperiences',
            [
                'userExperiences' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );

        if(!empty($userExperience)){
            return [
                'userExperience' => $userExperience,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
