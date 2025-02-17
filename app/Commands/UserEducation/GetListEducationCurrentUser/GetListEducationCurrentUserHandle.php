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
            $userId = auth()->user()->id;

            $user = $this->userRepository->findWithRelationships(
                $userId,
                'userEducations',
                [
                    'userEducations' => function ($query) {
                        return $query->orderByDesc('id');
                    }
                ]
            );

            return [
                'user' => new CurrentUserEducationResource($user),
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
