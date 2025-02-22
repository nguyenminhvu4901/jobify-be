<?php

namespace App\Repositories\UserProductResource;

use App\Entities\UserProductResource\UserProductResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserProductResourceRepositoryEloquent extends BaseRepository implements  UserProductResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProductResource::class;
    }

    /**
     * @param array $userProductResourceId
     * @return mixed
     */
    public function getListUserProductResourceByIds(array $userProductResourceId): mixed
    {
        return $this->model->whereIn('id', $userProductResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userProductResource = $this->model->create($attributes);

            DB::commit();

            return $userProductResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param $userProductResourceId
     * @return mixed
     */
    public function updateUserProductResource(array $attributes, $userProductResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userProductResource = $this->model->find($userProductResourceId);

            $userProductResource->update($attributes);

            DB::commit();

            return $userProductResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserProductResource $userProductResource
     * @return UserProductResource|null
     */
    public function destroy(UserProductResource $userProductResource): ?UserProductResource
    {
        DB::beginTransaction();

        try {
            $userProductResource->delete();

            DB::commit();

            return $userProductResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
