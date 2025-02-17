<?php

namespace App\Commands\UserEducation\GetCompleteListOfUserEducation;

use App\Http\Resources\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;

class GetCompleteListOfUserEducationHandle
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userEducation = $this->userEducationRepository->getWithRelationship('user');

            return [
                'userEducation' => UserEducationResource::collection($userEducation),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }

    }
}
