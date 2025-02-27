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
            $result = $this->userProductRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command), $command->userProductId);

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            if(!empty($command->attachments)){

                $this->userProductService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userProductResource: $result['data']->userProductResources,
                    userProductId: $command->userProductId
                );
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
     * @param UpdateUserProductCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserProductCommand $command): array
    {
        return [
            'name' => $command->name,
            'category' => $command->category,
            'finished_date' => $command->finishedDate,
            'description' => $command->description
        ];
    }
}
