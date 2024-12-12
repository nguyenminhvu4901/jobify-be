<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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

    public function search(array $params): Collection|LengthAwarePaginator
    {
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|null
     */
    public function create(array $data)
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

    public function find($id, $columns = ['*'])
    {
    }

    public function update(array $data, $id)
    {
    }
}
