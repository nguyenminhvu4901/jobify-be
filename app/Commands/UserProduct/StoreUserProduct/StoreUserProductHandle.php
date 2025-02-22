<?php

namespace App\Commands\UserProduct\StoreUserProduct;

use App\Http\Resources\UserProduct\UserProductResource;
use App\Http\Resources\UserProject\UserProjectResource;
use App\Repositories\UserProduct\UserProductRepository;
use App\Services\UserProduct\UserProductService;

class StoreUserProductHandle
{
    public function __construct(
        protected UserProductRepository $userProductRepository,
        protected UserProductService $userProductService
    )
    {
    }

    public function handle(StoreUserProductCommand $command): array
    {
        try {
            $userId = auth()->user()->id;

            $userProduct = $this->userProductRepository->store([
                'user_id' => $userId,
                'name' => $command->name,
                'category' => $command->category,
                'finished_date' => $command->finished_date,
                'description' => $command->description
            ]);

            if(!empty($command->attachments))
            {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment)
                {
                    $pathStorage = $this->userProductService->saveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userProductService->storeUserProductResource(
                            attachment: $attachment,
                            userProductId: $userProduct->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            if($userProduct){
                $userProduct->refresh();
            }

            return [
                'userProject' => UserProductResource::make($userProduct),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
