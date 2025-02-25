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
                'finished_date' => $command->finishedDate,
                'description' => $command->description
            ], $command->userProductId);

            if($userProduct){
                if(!empty($command->attachments)){

                    $this->userProductService->updateResourceAttachment(
                        attachments: $command->attachments,
                        userProductResource: $userProduct->userProductResources,
                        userProductId: $command->userProductId
                    );
                }

                $userProduct->load(['userProductResources.contentType', 'user']);

                return [
                    'message' => __('messages.profile.user_update_profile_success'),
                    'userProduct' => UserProductResource::make($userProduct)
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
