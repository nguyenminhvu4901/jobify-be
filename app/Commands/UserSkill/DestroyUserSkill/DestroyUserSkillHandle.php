<?php

namespace App\Commands\UserSkill\DestroyUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserSkillHandle
{
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    )
    {
    }

    public function handle(DestroyUserSkillCommand $command)
    {
        $userSkill = $this->userSkillRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userSkillId
        );

        if (!$userSkill) {
            return [
                'message' => __('messages.response.resource_not_found'),
                'status_code' => ResponseAlias::HTTP_NOT_FOUND
            ];
        }

        $userEducationDelete = $this->userSkillRepository->destroy($userSkill);

        if ($userEducationDelete) {
            return [
                'userSkill' => $userSkill,
                'message' => __('messages.profile.user_destroy_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_destroy_profile_error'),
            'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        ];
    }
}
