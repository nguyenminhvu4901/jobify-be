<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug;

use App\Http\Resources\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationByUserSlugHandle
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
     * @param GetDetailListOfUserEducationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationByUserSlugCommand $command): array
    {
        try {
            $userEducation = $this->userEducationRepository->getByRelationshipUserSlug(
                $command->userSlug,
                'user'
            );

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
