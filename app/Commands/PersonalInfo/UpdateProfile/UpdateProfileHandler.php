<?php

namespace App\Commands\PersonalInfo\UpdateProfile;

use App\Http\Resources\ProfileSeries\UserProfile\UserProfileResource;
use App\Repositories\ProfileSeries\UserProfile\UserProfileRepository;
use App\Repositories\User\UserRepository;
use App\Traits\ImageHandler;

class UpdateProfileHandler
{
    use ImageHandler;

    public function __construct(
        protected UserRepository $userRepository,
        protected UserProfileRepository $userProfileRepository
    ) {
    }

    public function handle(UpdateProfileCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $user = $this->userRepository->update([
                'full_name' => $command->fullName,
                'phone_number' => $command->phoneNumber,
            ], $userId);

            $this->userProfileRepository->updateOrCreateUserProfile(
                ['user_id' => $userId],
                [
                    'user_id' => $userId,
                    'position' => $command->position,
                    'gender_id' => $command->gender,
                    'birth_date' => $command->birthDate,
                    'description' => $command->description,
                ]
            );

            if (! empty($user)) {
                return [
                    'user' => UserProfileResource::make($user->refresh()),
                    'message' => __('messages.profile.user_update_profile_success'),
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error'),
            ];
        } catch (\Exception $e) {
            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }
}
