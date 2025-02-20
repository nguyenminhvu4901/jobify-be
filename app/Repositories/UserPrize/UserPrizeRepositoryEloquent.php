<?php

namespace App\Repositories\UserPrize;

use App\Entities\UserPrize\UserPrize;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserPrizeRepositoryEloquent extends BaseRepository implements UserPrizeRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserPrize::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userPrize = $this->model->create($attributes);

            DB::commit();

            return $userPrize;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userPrizeId
     * @return mixed
     */
    public function updateUserPrize(array $attributes, int|string $userPrizeId): mixed
    {
        DB::beginTransaction();

        try {
            $userPrize = $this->model->find($userPrizeId);

            $userPrize->update($attributes);

            DB::commit();

            return $userPrize;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserPrize $userPrize
     * @return bool
     */
    public function destroy(UserPrize $userPrize): bool
    {
        DB::beginTransaction();

        try {
            $userPrize->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
