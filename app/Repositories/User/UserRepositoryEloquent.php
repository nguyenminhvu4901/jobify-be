<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param array $attributes
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {

            $user = $this->model->create($attributes);

            $user->syncRoles($attributes['role'] ?? null);

            DB::commit();

            return $user->refresh();
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @return User|null
     */
    public function changePassword(array $attributes): ?User
    {
        DB::beginTransaction();

        try {
            $user = $this->findBySlug($attributes['slug'] ?? null);

            $user->update([
                'password' => $attributes['new_password']
            ]);

            DB::commit();

            return $user;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function update(array $attributes, $userId): mixed
    {
        DB::beginTransaction();

        try {
            $user = $this->find($userId);

            $user->update($attributes);

            DB::commit();

            return $user->refresh();
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }
}
