<?php

namespace App\Commands\Profile\UserProduct\StoreUserProduct;

use App\Http\Resources\Profile\UserProduct\UserProductResource;
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
            $result = $this->userProductRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments))
            {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment)
                {
                    $pathStorage = $this->userProductService->saveAttachment($attachment);

                    if(!empty($pathStorage)){
                        $this->userProductService->storeUserProductResource(
                            attachment: $attachment,
                            userProductId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
            }

            $result['data']->load(['userProductResources.contentType', 'user']);

            return [
                'data' => UserProductResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param StoreUserProductCommand $command
     * @return array
     */
    private function prepareUserActivityData(StoreUserProductCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'category' => $command->category,
            'finished_date' => $command->finishedDate,
            'description' => $command->description
        ];
    }
}
