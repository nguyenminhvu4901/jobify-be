<?php

namespace App\Commands\Auth\JobSeekerRegister;

use App\Enums\DefaultRole;
use App\Http\Resources\Auth\JobSeekerRegisterResource;
use App\Notifications\UserRegisteredNotification;
use App\Repositories\User\UserRepository;

class JobSeekerRegisterHandler
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    /**
     * @param JobSeekerRegisterCommand $command
     * @return array
     */
    public function handle(JobSeekerRegisterCommand $command): array
    {
        try {
            $jobSeeker =  $this->userRepository->create([
                'full_name' => $command->fullName,
                'email' => $command->email,
                'password' => $command->password,
                'phone_number' => $command->phoneNumber,
                'current_role' => DefaultRole::JOBSEEKER,
                'role' => DefaultRole::JOBSEEKER
            ]);

            if(!empty($jobSeeker)){
                $jobSeeker->notify(new UserRegisteredNotification());

                return [
                    'jobSeeker' => JobSeekerRegisterResource::make($jobSeeker->refresh()),
                    'message' => __('messages.authentication.user_register_success'),
                ];
            }

            return [
                'message' => __('messages.authentication.user_register_error'),
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.authentication.user_register_error'),
                'error' => $e
            ];
        }
    }
}
