<?php

namespace App\Commands\UserCertification\GetListCertificationCurrentUser;

use App\Http\Resources\UserCertification\CurrentUserCertificationResource;
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
        try {
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

            return [
                'userCertification' => CurrentUserCertificationResource::make($userCertification),
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
