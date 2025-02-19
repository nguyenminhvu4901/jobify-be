<?php

namespace App\Repositories\UserProjectResource;

use App\Entities\UserProjectResource\UserProjectResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserProjectResourceRepositoryEloquent extends BaseRepository implements UserProjectResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProjectResource::class;
    }

    /**
     * @param array $userProjectResourceId
     * @return mixed
     */
    public function getListUserProjectResourceByIds(array $userProjectResourceId): mixed
    {
        return $this->model->whereIn('id', $userProjectResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userProjectResource = $this->model->create($attributes);

            DB::commit();

            return $userProjectResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userProjectResourceId
     * @return mixed
     */
    public function updateUserProjectResource(array $attributes, int|string $userProjectResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userProjectResource = $this->model->find($userProjectResourceId);

            $userProjectResource->update($attributes);

            DB::commit();

            return $userProjectResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserProjectResource $userProjectResource
     * @return UserProjectResource|null
     */
    public function destroy(UserProjectResource $userProjectResource): ?UserProjectResource
    {
        DB::beginTransaction();

        try {
            $userProjectResource->delete();

            DB::commit();

            return $userProjectResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
