<?php

namespace App\Commands\UserExperience\GetListExperienceCurrentUser;

use App\Repositories\User\UserRepository;

class GetListExperienceCurrentUserHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle()
    {
        $user = auth()->user();

        return $this->userRepository->getListUserExperience($user->id);
    }
}
