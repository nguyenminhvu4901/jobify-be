<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
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
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|null
     */
    public function create(array $data): mixed
    {
        DB::beginTransaction();

        try {

            $user = $this->model->create($data);

            $user->syncRoles($data['role'] ?? null);

            DB::commit();

            return $user->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }

    public function changePassword($data)
    {
        DB::beginTransaction();

        try {
            $user = $this->findBySlug($data['slug'] ?? null);

            $user->update([
                'password' => $data['new_password']
            ]);

            DB::commit();

            return $user;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
