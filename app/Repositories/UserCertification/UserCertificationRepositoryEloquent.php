<?php

namespace App\Repositories\UserCertification;

use App\Entities\UserCertification\UserCertification;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserCertificationRepositoryEloquent extends BaseRepository implements UserCertificationRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserCertification::class;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->model->create($attributes);

            if(!$userCertification){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userCertification
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param array $attributes
     * @param int $userCertificationId
     * @return array
     */
    public function updateUserCertification(array $attributes, int $userCertificationId): array
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->findWithRelationships($userCertificationId, 'userCertificationResources');

            if(!$userCertification){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userCertification->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'data' => $userCertification->refresh()
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    public function destroy($userCertification)
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userCertification->delete();

            DB::commit();

            return [
                'success' => (bool) $isDeleted
            ];
        }catch (Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}
