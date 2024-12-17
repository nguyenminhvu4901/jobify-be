<?php

namespace App\Commands\PersonalInfo\UpdateProfile;

use App\Repositories\User\UserRepository;
use App\Repositories\UserProfile\UserProfileRepository;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\DB;

class UpdateProfileHandler
{
    use ImageHandler;

    public function __construct(
        protected UserRepository $userRepository,
        protected UserProfileRepository $userProfileRepository
    )
    {}

    public function handle(UpdateProfileCommand $command)
    {
        return DB::transaction(function () use ($command) {
            $user = auth()->user();

            if($user){
                $this->userRepository->update([
                    'full_name' => $command->fullName,
                    'phone_number' => $command->phoneNumber
                ], $user->id);

                $this->userProfileRepository->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'user_id' => $user->id,
                        'position' => $command->position,
                        'gender_id' => $command->gender,
                        'birth_date' => $command->birthDate,
                        'description' => $command->description
                    ]
                );

                return $user->refresh();
            }

            return null;
        });
    }
}
