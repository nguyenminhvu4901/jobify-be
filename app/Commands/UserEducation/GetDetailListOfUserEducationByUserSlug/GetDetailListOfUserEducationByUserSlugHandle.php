<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug;

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
        $userEducation = $this->userEducationRepository->getByRelationshipUserSlug(
            $command->userSlug,
            'user'
        );

        if(!empty($userEducation)){
            return [
                'userEducation' => $userEducation,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
