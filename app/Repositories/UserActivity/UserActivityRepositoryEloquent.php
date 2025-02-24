<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserActivityRepositoryEloquent extends BaseRepository implements UserActivityRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivity::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userActivity = $this->model->create($attributes);

            DB::commit();

            return $userActivity;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int $userActivityId
     * @return mixed|null
     */
    public function updateUserActivity(array $attributes, int $userActivityId): mixed
    {
        DB::beginTransaction();

        try {
            $userActivity = $this->findWithRelationships($userActivityId, 'userActivityResources');

            $userActivity->update($attributes);

            DB::commit();

            return $userActivity;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserActivity $userActivity
     * @return bool
     */
    public function destroy(UserActivity $userActivity): bool
    {
        DB::beginTransaction();

        try {
            $userActivity->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
