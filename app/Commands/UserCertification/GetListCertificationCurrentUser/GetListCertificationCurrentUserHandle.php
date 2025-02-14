<?php

namespace App\Commands\UserCertification\GetListCertificationCurrentUser;

use App\Repositories\User\UserRepository;

class GetListCertificationCurrentUserHandle
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
        $user = auth()->user();

        $userCertification =  $this->userRepository->findWithRelationships(
            $user->id,
            'userCertifications',
            [
                'userCertifications' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );

        if(!empty($userCertification)){
            return [
                'userCertification' => $userCertification,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
