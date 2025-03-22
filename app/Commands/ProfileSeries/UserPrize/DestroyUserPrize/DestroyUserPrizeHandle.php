<?php

namespace App\Commands\ProfileSeries\UserPrize\DestroyUserPrize;

use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use App\Repositories\ProfileSeries\UserPrizeResource\UserPrizeResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserPrizeHandle
{
    /**
     * @param UserPrizeRepository $userPrizeRepository
     * @param UserPrizeResourceRepository $userPrizeResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository,
        protected UserPrizeResourceRepository $userPrizeResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserPrizeCommand $command
     * @return array
     */
    public function handle(DestroyUserPrizeCommand $command): array
    {
        try {
            $userPrize = $this->userPrizeRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userPrizeId,
                relationship: 'userPrizeResources'
            );

            if (!$userPrize) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if($userPrize->userPrizeResources->isNotEmpty()){
                foreach ($userPrize->userPrizeResources as $resource){
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userPrizeResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userPrizeRepository->destroyDataWithTransaction($userPrize->id);

            if($result['success']){

                return [
                    'userPrizeDestroy' => $result['success'],
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
