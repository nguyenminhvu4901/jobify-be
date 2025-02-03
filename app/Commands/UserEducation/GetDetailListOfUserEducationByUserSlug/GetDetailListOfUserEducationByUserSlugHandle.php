<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug;

use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationByUserSlugHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    public function handle(GetDetailListOfUserEducationByUserSlugCommand $command)
    {
        $userEducation = $this->userEducationRepository->findByRelationshipUserSlug(
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
