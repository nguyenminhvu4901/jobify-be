<?php

namespace App\Repositories\UserActivityResource;

use App\Entities\UserActivityResource\UserActivityResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserActivityResourceRepositoryEloquent extends BaseRepository implements UserActivityResourceRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivityResource::class;
    }

    /**
     * @param array $userActivityResourceId
     * @return mixed
     */
    public function getListUserActivityResourceByIds(array $userActivityResourceId): mixed
    {
        return $this->model->whereIn('id', $userActivityResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userActivityResource = $this->model->create($attributes);

            DB::commit();

            return $userActivityResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userActivityResourceId
     * @return mixed
     */
    public function updateUserActivityResource(array $attributes, int|string $userActivityResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userActivityResource = $this->model->find($userActivityResourceId);

            $userActivityResource->update($attributes);

            DB::commit();

            return $userActivityResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserActivityResource $userActivityResource
     * @return UserActivityResource|null
     */
    public function destroy(UserActivityResource $userActivityResource): ?UserActivityResource
    {
        DB::beginTransaction();

        try {
            $userActivityResource->delete();

            DB::commit();

            return $userActivityResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
