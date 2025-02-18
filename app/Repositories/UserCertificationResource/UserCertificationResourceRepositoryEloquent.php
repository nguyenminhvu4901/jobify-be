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

    public function store(array $attributes)
    {
        DB::beginTransaction();

        try {
            $userCertificationResource = $this->model->create($attributes);

            DB::commit();

            return $userCertificationResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    public function updateUserCertificationResource(
        array $attributes, string|int $userCertificationResourceId
    )
    {
        DB::beginTransaction();

        try {
            $userCertificationResource = $this->model->find($userCertificationResourceId);

            $userCertificationResource->update($attributes);

            DB::commit();

            return $userCertificationResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
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

            return $userCertificationResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

}
