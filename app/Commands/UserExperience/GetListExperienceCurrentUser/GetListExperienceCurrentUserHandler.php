<?php

namespace App\Commands\UserExperience\GetListExperienceCurrentUser;

use App\Repositories\User\UserRepository;

class GetListExperienceCurrentUserHandler
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    /**
     * @return array
     */
    public function handle(): array
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
