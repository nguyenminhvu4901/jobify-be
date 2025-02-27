<?php

namespace App\Commands\UserProduct\DestroyUserProduct;

use App\Repositories\UserProduct\UserProductRepository;
use App\Repositories\UserProductResource\UserProductResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserProductHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     * @param UserProductResourceRepository $userProductResourceRepository
     * @param AttachmentResourceService $attachmentResourceService
     */
    public function __construct(
        protected UserProductRepository $userProductRepository,
        protected UserProductResourceRepository $userProductResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    /**
     * @param DestroyUserProductCommand $command
     * @return array
     */
    public function handle(DestroyUserProductCommand $command): array
    {
        try {
            $userProduct = $this->userProductRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userProductId,
                relationship: 'userProductResources'
            );

            if (!$userProduct) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            if($userProduct->userProductResources->isNotEmpty()){
                foreach ($userProduct->userProductResources as $resource){
                    $this->attachmentResourceService->deleteFileAttachment($resource);
                    $this->userProductResourceRepository->destroyDataWithTransaction($resource->id);
                }
            }

            $result = $this->userProductRepository->destroyDataWithTransaction($userProduct->id);

            if($result['success']){

                return [
                    'userProductDestroy' => $result['success'],
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
