<?php

namespace App\Commands\ProfileSeries\UserEducation\GetDetailListOfUserEducationByUserSlug;

use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserEducation\UserEducationResource;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserEducationByUserSlugHandle
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
     * @param GetDetailListOfUserEducationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationByUserSlugCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([UserEducationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserEducationEnum::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value,
                    $command
                )
            );

            $userEducation = redisCacheDB()->tags([UserEducationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserEducationEnum::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() =>  $this->userEducationRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: 'user'
                )
            );

            return [
                'data' => UserEducationResource::collection($userEducation),
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
