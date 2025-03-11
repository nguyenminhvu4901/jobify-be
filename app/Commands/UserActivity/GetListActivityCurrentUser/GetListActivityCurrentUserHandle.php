<?php

namespace App\Commands\UserActivity\GetListActivityCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserActivity;
use App\Http\Resources\UserActivity\CurrentUserActivityResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListActivityCurrentUserHandle
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserActivity::TAG_NAME->value])->has(
                UserActivity::LIST_ACTIVITY_CURRENT_USER->value . auth()->user()->id);

            $userActivities = Cache::tags([UserActivity::TAG_NAME->value])
                ->remember(
                    UserActivity::LIST_ACTIVITY_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    function() {

                        return $this->userRepository->findWithRelationships(
                            id: auth()->user()->id,
                            relationship: 'userActivities.userActivityResources.contentType',
                            relationshipCallbacksToFilter: [
                                'userActivities' => function ($query) {
                                    $query->orderByDesc('id')
                                    ->with([
                                        'userActivityResources' => function ($query) {
                                            $query->orderByDesc('id')
                                            ->with('contentType');
                                        }
                                    ]);
                                }
                            ]
                        );
            });


            if(empty($userActivities)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserActivityResource::make($userActivities),
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
