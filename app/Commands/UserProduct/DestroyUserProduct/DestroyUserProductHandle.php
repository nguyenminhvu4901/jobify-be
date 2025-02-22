<?php

namespace App\Commands\UserProduct\DestroyUserProduct;

use App\Repositories\UserProduct\UserProductRepository;
use App\Repositories\UserProductResource\UserProductResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

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
                    'message' => __('messages.profile.user_destroy_profile_error')
                ];
            }

            $userProduct->userProductResources?->each(function ($eachUserProductResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserProductResource);
                $this->userProductResourceRepository->destroy($eachUserProductResource);
            });

            $userProductDestroy = $this->userProductRepository->destroy($userProduct);

            if($userProductDestroy){
                return [
                    'userProductDestroy' => true,
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
