<?php

namespace App\Commands\PersonalInfo\UpdateProfile;

use App\Repositories\User\UserRepository;
use App\Repositories\UserProfile\UserProfileRepository;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class UpdateProfileHandler
{
    use ImageHandler;

    /**
     * @param UserRepository $userRepository
     * @param UserProfileRepository $userProfileRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected UserProfileRepository $userProfileRepository
    )
    {}


    /**
     * @param UpdateProfileCommand $command
     * @return array
     */
    public function handle(UpdateProfileCommand $command): array
    {
        $userId = auth()->user()->id;

        $user =  $this->userRepository->update([
            'full_name' => $command->fullName,
            'phone_number' => $command->phoneNumber
        ], $userId);

        $this->userProfileRepository->updateOrCreateUserProfile(
            ['user_id' => $userId],
            [
                'user_id' => $userId,
                'position' => $command->position,
                'gender_id' => $command->gender,
                'birth_date' => $command->birthDate,
                'description' => $command->description
            ]
        );

        if(!empty($user)){
            return [
                'user' => $user,
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_update_profile_error')
        ];
    }
}
