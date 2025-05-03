<?php

namespace App\Commands\ProfileSeries\UserProduct\UpdateUserProduct;

use App\Http\Resources\ProfileSeries\UserProduct\UserProductResource;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepository;
use App\Services\ProfileSeries\UserProduct\UserProductService;

class UpdateUserProductHandle
{
    public function __construct(
        protected UserProductRepository $userProductRepository,
        protected UserProductService $userProductService
    ) {
    }

    public function handle(UpdateUserProductCommand $command): array
    {
        try {
            $result = $this->userProductRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userProductId
            );

            if (! $result['success']) {
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {

                $this->userProductService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userProductResource: $result['data']->userProductResources,
                    userProductId: $command->userProductId
                );
            }

            return [
                'data' => UserProductResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(UpdateUserProductCommand $command): array
    {
        return [
            'name' => $command->name,
            'category' => $command->category,
            'finished_date' => $command->finishedDate,
            'description' => $command->description,
        ];
    }
}
