<?php

namespace App\Commands\UserProduct\UpdateUserProduct;

use App\Http\Resources\UserProduct\UserProductResource;
use App\Repositories\UserProduct\UserProductRepository;
use App\Services\UserProduct\UserProductService;

class UpdateUserProductHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     * @param UserProductService $userProductService
     */
    public function __construct(
        protected UserProductRepository $userProductRepository,
        protected UserProductService $userProductService
    )
    {
    }

    /**
     * @param UpdateUserProductCommand $command
     * @return array
     */
    public function handle(UpdateUserProductCommand $command): array
    {
        try {
            $userProduct = $this->userProductRepository->updateUserProduct([
                'name' => $command->name,
                'category' => $command->category,
                'finished_date' => $command->finished_date,
                'description' => $command->description
            ], $command->userProductId);

            if(!empty($command->attachments)){

                $attachments = $command->attachments;
                $userProductResource = $userProduct->userProductResources;

                $this->userProductService->updateResourceAttachment(
                    attachments: $attachments,
                    userProductResource: $userProductResource,
                    userProductId: $command->userProductId
                );
            }

            if ($userProduct) {
                $userProduct->refresh();
            }

            return [
                'message' => __('messages.profile.user_update_profile_success'),
                'userProject' => UserProductResource::make($userProduct)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
