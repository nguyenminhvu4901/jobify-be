<?php

namespace App\Commands\UserEducation\GetListEducationCurrentUser;

use App\Repositories\User\UserRepository;

class GetListEducationCurrentUserHandle
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function handle(GetListEducationCurrentUserCommand $command)
    {
        $user = auth()->user();

        return $this->userRepository->findWithRelationships(
            $user->id,
            'userEducations',
            [
                'userEducations' => function ($query) {
                    return $query->orderByDesc('id');
                }
            ]
        );
    }
}
