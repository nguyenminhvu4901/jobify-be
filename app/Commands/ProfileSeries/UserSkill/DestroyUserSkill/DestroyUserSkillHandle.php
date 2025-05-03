<?php

namespace App\Commands\ProfileSeries\UserSkill\DestroyUserSkill;

use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserSkillHandle
{
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    ) {
    }

    public function handle(DestroyUserSkillCommand $command): array
    {
        try {
            $userSkill = $this->userSkillRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userSkillId
            );

            if (! $userSkill) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                ];
            }

            $result = $this->userSkillRepository->destroyDataWithTransaction($userSkill->id);

            if ($result['success']) {
                return [
                    'userSkillDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success'),
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }
}
