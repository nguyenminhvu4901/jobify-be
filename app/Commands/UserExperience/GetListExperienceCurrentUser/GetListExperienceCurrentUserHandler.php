<?php

namespace App\Commands\UserExperience\GetListExperienceCurrentUser;

use App\Http\Resources\UserExperience\CurrentUserExperienceResource;
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
        try {
            $user = auth()->user();

            $userExperience = $this->userRepository->findWithRelationships(
                $user->id,
                'userExperiences.userExperienceResource.contentType',
                [
                    'userExperiences' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            return [
                'userExperience' => CurrentUserExperienceResource::make($userExperience),
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
