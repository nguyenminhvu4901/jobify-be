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
            $userExperience = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userExperiences.userExperienceResource.contentType',
                [
                    'userExperiences' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userExperience)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserExperienceResource::make($userExperience),
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
