<?php

namespace App\Commands\UserPrize\DestroyUserPrize;

use App\Repositories\UserPrize\UserPrizeRepository;
use App\Repositories\UserPrizeResource\UserPrizeResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;

class DestroyUserPrizeHandle
{
    public function __construct(
        protected UserPrizeRepository $userPrizeRepository,
        protected UserPrizeResourceRepository $userPrizeResourceRepository,
        protected AttachmentResourceService $attachmentResourceService
    )
    {
    }

    public function handle(DestroyUserPrizeCommand $command): array
    {
        try {
            $userPrize = $this->userPrizeRepository->findByRelationshipUserSlugAndColumnDetailId(
                userSlug: $command->userSlug,
                idColumn: $command->userPrizeId,
                relationship: 'userPrizeResources'
            );

            if (!$userPrize) {
                return [
                    'message' => __('messages.profile.user_destroy_profile_error')
                ];
            }

            $userPrize->userPrizeResources?->each(function ($eachUserPrizeResource) {
                $this->attachmentResourceService->deleteFileAttachment($eachUserPrizeResource);
                $this->userPrizeResourceRepository->destroy($eachUserPrizeResource);
            });

            $userPrizeDestroy = $this->userPrizeRepository->destroy($userPrize);

            if($userPrizeDestroy){
                return [
                    'userPrizeDestroy' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error')
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e
            ];
        }
    }
}
