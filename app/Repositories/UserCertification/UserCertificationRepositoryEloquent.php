<?php

namespace App\Repositories\UserCertification;

use App\Entities\UserCertification\UserCertification;
use App\Repositories\BaseRepository;
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
     * @param array $data
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $data): mixed
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->model->create($data);

            DB::commit();

            return $userCertification->refresh();
        }catch (\Exception $e){
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
        }catch (\Exception $e)
        {
            DB::rollBack();

            return false;
        }
    }

    /**
     * @param array $data
     * @param $userCertificationId
     * @return mixed|null
     */
    public function updateUserCertification(array $data, $userCertificationId): mixed
    {
        DB::beginTransaction();

        try {
            $userCertification = $this->findWithRelationships($userCertificationId, 'userCertificationResources');

            $userCertification->update($data);

            DB::commit();

            return  $userCertification;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
