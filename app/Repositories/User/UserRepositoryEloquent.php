<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
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
     * @return LengthAwarePaginator|Collection|mixed|null
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

    /**
     * @param $data
     * @return User|null
     */
    public function changePassword($data): ?User
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

    /**
     * @param array $data
     * @param $userId
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function update(array $data, $userId): mixed
    {
        DB::beginTransaction();

        try {
            $user = $this->find($userId);

            $user->update($data);

            DB::commit();

            return $user->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function getListUserExperienceByUserId($userId): Model|\Illuminate\Database\Eloquent\Collection|null
    {
        return $this->model->with(['userExperiences' => function ($query) {
            $query->orderByDesc('id');
        }])->find($userId);
    }
}
