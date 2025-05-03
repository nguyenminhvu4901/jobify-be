<?php

namespace App\Commands\ProfileSeries\UserExperience\DestroyUserExperience;

use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepository;
use App\Repositories\ProfileSeries\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    ) {
    }

    public function handle(DestroyUserExperienceCommand $command): ?array
    {
        try {
            $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userExperienceId,
                relationship: 'userExperienceResource'
            );

            if (! $userExperience) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                ];
            }

            if ($userExperience?->userExperienceResource->isNotEmpty()) {
                foreach ($userExperience->userExperienceResource as $resource) {
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userExperienceResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userExperienceRepository->destroyDataWithTransaction($userExperience->id);

            if ($result['success']) {
                return [
                    'userExperienceDestroy' => $result['success'],
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
