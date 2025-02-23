<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrizeByUserSlug;

use App\Http\Resources\UserPrize\UserPrizeResource;
use App\Repositories\UserPrize\UserPrizeRepository;

class GetDetailListOfUserPrizeByUserSlugHandle
{
    /**
     * @param UserPrizeRepository $userPrizeRepository
     */
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserPrizeByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserPrizeByUserSlugCommand $command): array
    {
        try {
            $userPrize = $this->userPrizeRepository->getByRelationshipUserSlug(
                $command->userSlug,
                ['userPrizeResources.contentType', 'user']
            );

            return [
                'userPrize' => UserPrizeResource::collection($userPrize),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
