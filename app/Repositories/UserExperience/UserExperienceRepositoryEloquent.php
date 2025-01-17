<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;
use App\Repositories\BaseRepository;
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
     * @param array $data
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $data): mixed
    {
        DB::beginTransaction();

        try {
            $userExperience = $this->model->create($data);

            DB::commit();

            return $userExperience->refresh();
        }catch (\Exception $e){
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
            $userExperience = $this->findWithRelationships($userExperienceId, ['userExperienceResource']);

            $userExperience->update($data);

            DB::commit();

            return $userExperience->refresh();
        }catch (\Exception $e){
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
        }catch (\Exception $e)
        {
            DB::rollBack();

            return false;
        }
    }
}
