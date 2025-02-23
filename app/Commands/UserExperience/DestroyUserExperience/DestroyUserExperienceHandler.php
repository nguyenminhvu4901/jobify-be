<?php

namespace App\Commands\UserExperience\DestroyUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {}

    /**
     * @param DestroyUserExperienceCommand $command
     * @return array|null
     */
    public function handle(DestroyUserExperienceCommand $command): ?array
    {
        try {
            $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userExperienceId,
                relationship: 'userExperienceResource'
            );

            if (!$userExperience) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            DB::beginTransaction();

            $userExperience->userExperienceResource?->each(function ($eachUserExperienceResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserExperienceResource);
                $this->userExperienceResourceRepository->destroy($eachUserExperienceResource);
            });

            $userExperienceDestroy = $this->userExperienceRepository->destroy($userExperience);

            if($userExperienceDestroy){
                DB::commit();

                return [
                    'userExperienceDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error')
            ];

        }catch (\Exception $e){
            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e
            ];
        }
    }
}
