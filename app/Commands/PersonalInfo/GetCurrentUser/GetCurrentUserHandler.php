<?php

namespace App\Commands\PersonalInfo\GetCurrentUser;

use App\Repositories\User\UserRepository;

class GetCurrentUserHandler
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function handle()
    {
        $userId = auth()->user()->id;

        return $this->userRepository->find($userId);
    }
}
