<?php

namespace App\Commands\ProfileSeries\UserCertification\GetDetailListOfUserCertification;

use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserCertification\UserCertificationResource;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserCertificationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCertificationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCertificationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION->value,
                    $command
                ));

            $userCertification = Cache::tags([UserCertificationEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userCertificationRepository->findWithRelationships(
                            $command->userCertificationId,
                            ['user', 'userCertificationResources.contentType']
                    )
                );

            if(empty($userCertification)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserCertificationResource::make($userCertification),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
