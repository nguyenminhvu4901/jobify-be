<?php

namespace App\Commands\ProfileSeries\UserEducation\GetDetailListOfUserEducation;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Http\Resources\ProfileSeries\UserEducation\UserEducationResource;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserEducationHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserEducationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserEducationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserEducationEnum::DETAIL_LIST_USER_EDUCATION->value,
                    $command
                )
            );

            $userEducation = Cache::tags([UserEducationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserEducationEnum::DETAIL_LIST_USER_EDUCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userEducationRepository->findWithRelationships(
                    id: $command->userEducationId,
                    relationship: 'user'
                ));

            if(empty($userEducation)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserEducationResource::make($userEducation),
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
