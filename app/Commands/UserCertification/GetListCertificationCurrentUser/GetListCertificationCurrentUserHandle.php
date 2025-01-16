<?php

namespace App\Commands\UserCertification\GetListCertificationCurrentUser;

use App\Repositories\User\UserRepository;

class GetListCertificationCurrentUserHandle
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return mixed
     */
    public function handle(): mixed
    {
        $user = auth()->user();

        return $this->userRepository->findWithRelationships(
            $user->id,
            'userCertifications',
            [
                'userCertifications' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );
    }
}
