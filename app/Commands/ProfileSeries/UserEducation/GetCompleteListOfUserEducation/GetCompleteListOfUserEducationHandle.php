<?php

namespace App\Commands\ProfileSeries\UserEducation\GetCompleteListOfUserEducation;

use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserEducation\UserEducationResource;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserEducationHandle
{
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    ) {
    }

    public function handle(GetCompleteListOfUserEducationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserEducationEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserEducationEnum::COMPLETE_LIST_USER_EDUCATION->value,
                        $command
                    )
                );

            $userEducation = Cache::tags([UserEducationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserEducationEnum::COMPLETE_LIST_USER_EDUCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userEducationRepository->paginateWithRelationship(
                    relationship: ['user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserEducationResource::collection($userEducation),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userEducation ?? []),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
            ];
        }

    }
}
