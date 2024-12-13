<?php

namespace App\Commands\Auth\JobSeekerRegister;

use App\Enums\DefaultRole;
use App\Repositories\User\UserRepository;

class JobSeekerRegisterHandler
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    public function handle(JobSeekerRegisterCommand $command)
    {
        return $this->userRepository->create([
            'full_name' => $command->fullName,
            'email' => $command->email,
            'password' => $command->password,
            'phone_number' => $command->phoneNumber,
            'current_role' => DefaultRole::JOBSEEKER,
            'role' => DefaultRole::JOBSEEKER
        ]);
    }
}
