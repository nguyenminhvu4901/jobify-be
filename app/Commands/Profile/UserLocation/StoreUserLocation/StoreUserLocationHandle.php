<?php

namespace App\Commands\Profile\UserLocation\StoreUserLocation;

use App\Http\Resources\Profile\UserLocation\UserLocationResource;
use App\Repositories\UserLocation\UserLocationRepository;

class StoreUserLocationHandle
{
    public function __construct(
        protected UserLocationRepository $userLocationRepository
    )
    {
    }

    public function handle(StoreUserLocationCommand $command): array
    {
        try {
            $result = $this->userLocationRepository->storeDataWithTransaction(
                $this->prepareUserLocationData($command)
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            $result['data']->load(['user', 'province', 'district', 'ward']);

            return [
                'data' => UserLocationResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.user_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param StoreUserLocationCommand $command
     * @return array
     */
    private function prepareUserLocationData(StoreUserLocationCommand $command): array
    {
        return [
            'user_id' => auth()?->user()?->id,
            'province_id' => $command->provinceId,
            'district_id' => $command->districtId,
            'ward_id' => $command->wardId,
            'address' => $command->address
        ];
    }
}
