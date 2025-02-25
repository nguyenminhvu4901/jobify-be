<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserCertificationResourceRepositoryEloquent extends BaseRepository implements UserCertificationResourceRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserCertificationResource::class;
    }

    /**
     * @param array $userCertificationResourceId
     * @return mixed
     */
    public function getListUserCertificationResourceByIds(array $userCertificationResourceId): mixed
    {
        return $this->model->whereIn('id', $userCertificationResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function store(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $userCertificationResource = $this->model->create($attributes);

            if(!$userCertificationResource){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userCertificationResource
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

    /**
     * @param array $attributes
     * @param string|int $userCertificationResourceId
     * @return array
     */
    public function updateUserCertificationResource(
        array $attributes, string|int $userCertificationResourceId
    ): array
    {
        DB::beginTransaction();

        try {
            $userCertificationResource = $this->model->find($userCertificationResourceId);

            if(!$userCertificationResource){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userCertificationResource->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'userCertificationResource' => $userCertificationResource->refresh()
            ];
        }catch (Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }


    /**
     * @param UserCertificationResource $userCertificationResource
     * @return array|bool[]
     */
    public function destroy(UserCertificationResource $userCertificationResource): array
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userCertificationResource->delete();

            DB::commit();

            return [
                'success' => (bool) $isDeleted
            ];
        }catch (Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

}
