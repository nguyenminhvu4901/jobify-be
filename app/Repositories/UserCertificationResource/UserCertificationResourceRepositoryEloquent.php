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
     * @param UserCertificationResource $userCertificationResource
     * @return UserCertificationResource|null
     */
    public function destroy(UserCertificationResource $userCertificationResource): ?UserCertificationResource
    {
        DB::beginTransaction();

        try {
            $userCertificationResource->delete();

            DB::commit();

            return $userCertificationResource->fresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

}
