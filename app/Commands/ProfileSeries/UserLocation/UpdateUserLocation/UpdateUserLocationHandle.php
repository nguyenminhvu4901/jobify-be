<?php

namespace App\Commands\ProfileSeries\UserLocation\UpdateUserLocation;

use App\Http\Resources\ProfileSeries\UserLocation\UserLocationResource;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;

class UpdateUserLocationHandle
{
    public function __construct(
        protected UserLocationRepository $userLocationRepository
    )
    {
    }

    public function handle(UpdateUserLocationCommand $command)
    {
        try {
            $result = $this->userLocationRepository->updateDataWithTransaction(
                $this->prepareUserLocationData($command),
                $command->userLocationId
            );

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            return [
                'data' => UserLocationResource::make($result['data']),
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
     * @param UpdateUserLocationCommand $command
     * @return array
     */
    private function prepareUserLocationData(UpdateUserLocationCommand $command): array
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
