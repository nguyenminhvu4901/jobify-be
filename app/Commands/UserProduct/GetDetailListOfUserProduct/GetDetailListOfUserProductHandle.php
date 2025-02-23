<?php

namespace App\Commands\UserProduct\GetDetailListOfUserProduct;

use App\Http\Resources\UserProduct\UserProductResource;
use App\Repositories\UserProduct\UserProductRepository;

class GetDetailListOfUserProductHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     */
    public function __construct(
        protected UserProductRepository $userProductRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserProductCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserProductCommand $command): array
    {
        try {
            $userProduct = $this->userProductRepository->findWithRelationships(
                $command->userProductId,
                ['user', 'userProductResources.contentType']
            );

            return [
                'userProduct' => UserProductResource::make($userProduct),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
