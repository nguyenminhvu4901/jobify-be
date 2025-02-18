<?php

namespace App\Repositories\UserCertification;

use App\Entities\UserCertification\UserCertification;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->model->create($attributes);

            DB::commit();

            return $userCertification;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param $userCertification
     * @return bool
     */
    public function destroy($userCertification): bool
    {
        DB::beginTransaction();

        try {
            $userCertification->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }

    /**
     * @param array $attributes
     * @param int $userCertificationId
     * @return mixed|null
     */
    public function updateUserCertification(array $attributes, int $userCertificationId): mixed
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->findWithRelationships($userCertificationId, 'userCertificationResources');

            $userCertification->update($attributes);

            DB::commit();

            return  $userCertification;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }
}
