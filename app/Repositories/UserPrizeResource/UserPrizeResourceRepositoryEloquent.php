<?php

namespace App\Repositories\UserPrizeResource;

use App\Entities\UserPrizeResource\UserPrizeResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserPrizeResourceRepositoryEloquent extends BaseRepository implements UserPrizeResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserPrizeResource::class;
    }

    /**
     * @param array $userPrizeResourceId
     * @return mixed
     */
    public function getListUserPrizeResourceByIds(array $userPrizeResourceId): mixed
    {
        return $this->model->whereIn('id', $userPrizeResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        try {
            $userPrizeResource = $this->model->create($attributes);

            DB::commit();

            return $userPrizeResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userPrizeResourceId
     * @return mixed
     */
    public function updateUserPrizeResource(array $attributes, int|string $userPrizeResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userPrizeResource = $this->model->find($userPrizeResourceId);

            $userPrizeResource->update($attributes);

            DB::commit();

            return $userPrizeResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserPrizeResource $userPrizeResource
     * @return UserPrizeResource|null
     */
    public function destroy(UserPrizeResource $userPrizeResource): ?UserPrizeResource
    {
        DB::beginTransaction();

        try {
            $userPrizeResource->delete();

            DB::commit();

            return $userPrizeResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
