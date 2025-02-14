<?php

namespace App\Commands\UserEducation\DestroyUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserEducationHandle
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
     * @param DestroyUserEducationCommand $command
     * @return array
     */
    public function handle(DestroyUserEducationCommand $command): array
    {
        $userEducation = $this->userEducationRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userEducationId
        );

        if (!$userEducation) {
            return [
                'message' => __('messages.response.resource_not_found'),
                'status_code' => ResponseAlias::HTTP_NOT_FOUND
            ];
        }

        $userEducationDelete = $this->userEducationRepository->destroy($userEducation);

        if ($userEducationDelete) {
            return [
                'userEducation' => $userEducation,
                'message' => __('messages.profile.user_destroy_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_destroy_profile_error'),
            'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        ];
    }
}
