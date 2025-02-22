<?php

namespace App\Commands\UserProduct\GetDetailListOfUserProductByUserSlug;

use App\Http\Resources\UserProduct\UserProductResource;
use App\Repositories\UserProduct\UserProductRepository;

class GetDetailListOfUserProductByUserSlugHandle
{
    /**
     * @param UserProductRepository $userProductRepository
     */
    public function __construct(
        protected UserProductRepository $userProductRepository
    )
    {
    }

    public function handle(GetDetailListOfUserProductByUserSlugCommand $command): array
    {
        try {
            $userProduct = $this->userProductRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userProductResources', 'user']
            );

            return [
                'userProduct' => UserProductResource::collection($userProduct),
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
