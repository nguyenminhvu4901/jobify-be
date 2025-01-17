<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Repositories\BaseRepository;
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
     * @param $userCertificationResource
     * @return mixed
     */
    public function destroy($userCertificationResource): mixed
    {
        DB::beginTransaction();

        try {
            $userCertificationResource->delete();

            DB::commit();

            return $userCertificationResource->fresh();
        }catch (\Exception $e)
        {
            DB::rollBack();

            return null;
        }
    }

}
