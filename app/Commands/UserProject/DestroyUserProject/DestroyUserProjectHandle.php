<?php

namespace App\Commands\UserProject\DestroyUserProject;

use App\Repositories\UserProject\UserProjectRepository;
use App\Repositories\UserProjectResource\UserProjectResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

class DestroyUserProjectHandle
{
    /**
     * @param UserProjectRepository $userProjectRepository
     * @param UserProjectResourceRepository $userProjectResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserProjectRepository $userProjectRepository,
        protected UserProjectResourceRepository $userProjectResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserProjectCommand $command
     * @return array
     */
    public function handle(DestroyUserProjectCommand $command): array
    {
        try {
            $userProject = $this->userProjectRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userProjectId,
                relationship: 'userProjectResources'
            );

            if (!$userProject) {
                return [
                    'message' => __('messages.profile.user_destroy_profile_error')
                ];
            }

            $userProject->userProjectResources?->each(function ($eachUserProjectResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserProjectResource);
                $this->userProjectResourceRepository->destroy($eachUserProjectResource);
            });

            $userProjectDestroy = $this->userProjectRepository->destroy($userProject);

            if($userProjectDestroy){
                return [
                    'userProjectDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error')
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e
            ];
        }
    }
}
