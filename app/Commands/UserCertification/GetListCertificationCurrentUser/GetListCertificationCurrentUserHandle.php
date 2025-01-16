<?php

namespace App\Commands\UserCertification\GetListCertificationCurrentUser;

use App\Repositories\UserCertification\UserCertificationRepository;

class GetListCertificationCurrentUserHandle
{
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    /**
     * @return mixed
     */
    public function handle(): mixed
    {
        $user = auth()->user();

        return $this->userCertificationRepository->findWithRelationships(
            $user->id,
            'userCertificationResources',
            [
                'userCertificationResources' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );
    }
}
