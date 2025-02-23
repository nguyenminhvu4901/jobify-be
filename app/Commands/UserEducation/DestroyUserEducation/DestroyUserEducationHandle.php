<?php

namespace App\Commands\UserEducation\DestroyUserEducation;

use App\Repositories\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserEducationHandle
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
     * @param DestroyUserEducationCommand $command
     * @return array
     */
    public function handle(DestroyUserEducationCommand $command): array
    {
        try {
            $userEducation = $this->userEducationRepository->findByRelationshipUserSlugAndColumnDetailId(
                $command->userSlug, $command->userEducationId
            );

            if (!$userEducation) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            DB::beginTransaction();

            $userEducationDelete = $this->userEducationRepository->destroy($userEducation);

            DB::commit();

            if ($userEducationDelete) {
                return [
                    'userEducationDelete' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
