<?php

namespace App\Commands\ProfileSeries\UserProject\DestroyUserProject;

use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use App\Repositories\ProfileSeries\UserProjectResource\UserProjectResourceRepository;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
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

            if($userProject->userProjectResources->isNotEmpty()){
                foreach ($userProject->userProjectResources as $resource){
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userProjectResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userProjectRepository->destroyDataWithTransaction($userProject->id);

            if($result['success']){

                return [
                    'userProjectDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
