<?php

namespace App\Repositories\UserProject;

use App\Entities\UserProject\UserProject;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserProjectRepositoryEloquent extends BaseRepository implements UserProjectRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProject::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userProject = $this->model->create($attributes);

            DB::commit();

            return $userProject;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param $userProjectId
     * @return mixed
     */
    public function updateUserProject(array $attributes, $userProjectId): mixed
    {
        DB::beginTransaction();

        try {
            $userProject = $this->model->find($userProjectId);

            $userProject->update($attributes);

            DB::commit();

            return $userProject;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserProject $userProject
     * @return bool
     */
    public function destroy(UserProject $userProject): bool
    {
        DB::beginTransaction();

        try {
            $userProject->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
