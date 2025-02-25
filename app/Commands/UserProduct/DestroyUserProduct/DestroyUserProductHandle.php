<?php

namespace App\Commands\UserProduct\DestroyUserProduct;

use App\Repositories\UserProduct\UserProductRepository;
use App\Repositories\UserProductResource\UserProductResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Support\Facades\DB;
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

            DB::beginTransaction();

            $userProduct->userProductResources?->each(function ($eachUserProductResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserProductResource);
                $this->userProductResourceRepository->destroy($eachUserProductResource);
            });

            $userProductDestroy = $this->userProductRepository->destroy($userProduct);

            if($userProductDestroy){
                DB::commit();

                return [
                    'userProductDestroy' => true,
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
