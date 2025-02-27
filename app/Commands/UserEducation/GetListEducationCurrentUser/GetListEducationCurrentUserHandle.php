<?php

namespace App\Commands\UserEducation\GetListEducationCurrentUser;

use App\Http\Resources\UserEducation\CurrentUserEducationResource;
use App\Repositories\User\UserRepository;

class GetListEducationCurrentUserHandle
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
            $userEducation = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                'userEducations',
                [
                    'userEducations' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            if(empty($userEducation)){

                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'user' => CurrentUserEducationResource::make($userEducation),
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
