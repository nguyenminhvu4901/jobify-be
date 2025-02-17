<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkillByUserSlug;

use App\Http\Resources\UserSkill\UserSkillResource;
use App\Repositories\UserSkill\UserSkillRepository;

class GetDetailListOfUserSkillByUserSlugHandle
{
    /**
     * @param UserSkillRepository $userSkillRepository
     */
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserSkillByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserSkillByUserSlugCommand $command): array
    {
        try {
            $userSkills = $this->userSkillRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['user', 'rate']
            );

            return [
                'userSkills' => UserSkillResource::collection($userSkills),
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
