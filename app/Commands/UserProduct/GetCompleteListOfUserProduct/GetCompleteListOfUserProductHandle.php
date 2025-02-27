<?php

namespace App\Commands\UserProduct\GetCompleteListOfUserProduct;

use App\Http\Resources\UserProduct\UserProductResource;
use App\Repositories\UserProduct\UserProductRepository;

class GetCompleteListOfUserProductHandle
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
     * @return array
     */
    public function handle(): array
    {
        try {
            $userProducts = $this->userProductRepository->getWithRelationship(
                ['userProductResources.contentType', 'user']
            );

            return [
                'data' => UserProductResource::collection($userProducts),
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
