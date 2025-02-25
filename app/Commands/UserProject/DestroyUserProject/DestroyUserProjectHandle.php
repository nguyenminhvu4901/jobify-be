<?php

namespace App\Commands\UserProject\DestroyUserProject;

use App\Repositories\UserProject\UserProjectRepository;
use App\Repositories\UserProjectResource\UserProjectResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            DB::beginTransaction();

            $userProject->userProjectResources?->each(function ($eachUserProjectResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserProjectResource);
                $this->userProjectResourceRepository->destroy($eachUserProjectResource);
            });

            $userProjectDestroy = $this->userProjectRepository->destroy($userProject);

            if($userProjectDestroy){
                DB::commit();

                return [
                    'userProjectDestroy' => true,
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
