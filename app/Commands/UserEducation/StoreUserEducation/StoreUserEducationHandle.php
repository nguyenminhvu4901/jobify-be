<?php

namespace App\Commands\UserEducation\StoreUserEducation;

use App\Http\Resources\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;

class StoreUserEducationHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @param StoreUserEducationCommand $command
     * @return array
     */
    public function handle(StoreUserEducationCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userEducation =  $this->userEducationRepository->store([
                'user_id' => $userId,
                'name' => $command->name,
                'major' => $command->major,
                'is_studying' => $command->isStudying,
                'start_date' => $command->startDate,
                'end_date' => $command->endDate,
                'description' => $command->description
            ]);

            if($userEducation){
                $userEducation->load('user');
            }

            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userEducation' => UserEducationResource::make($userEducation)
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
