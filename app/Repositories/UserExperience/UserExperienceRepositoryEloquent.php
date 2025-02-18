<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserExperienceRepositoryEloquent extends BaseRepository implements UserExperienceRepository
{
    public function model()
    {
        return UserExperience::class;
    }

    /**
     * @param array $attributes
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userExperience = $this->model->create($attributes);

            DB::commit();

            return $userExperience;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }


    /**
     * @param array $data
     * @param $userExperienceId
     * @return mixed
     */
    public function updateUserExperience(array $data, $userExperienceId): mixed
    {
        DB::beginTransaction();

        try {
            $userExperience = $this->model->find($userExperienceId);

            $userExperience->update($data);

            DB::commit();

            return $userExperience;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param $userExperience
     * @return bool
     */
    public function destroy($userExperience): bool
    {
        DB::beginTransaction();

        try {
            $userExperience->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
