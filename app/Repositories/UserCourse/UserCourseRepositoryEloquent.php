<?php

namespace App\Repositories\UserCourse;

use App\Entities\UserCourse\UserCourse;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserCourseRepositoryEloquent extends BaseRepository implements UserCourseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserCourse::class;
    }

    /**
     * @param array $attributes
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userCourse = $this->model->create($attributes);

            DB::commit();

            return $userCourse;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userCourseId
     * @return mixed
     */
    public function updateUserCourse(array $attributes, int|string $userCourseId): mixed
    {
        DB::beginTransaction();

        try {
            $userCourse = $this->model->find($userCourseId);

            $userCourse->update($attributes);

            DB::commit();

            return $userCourse;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserCourse $userCourse
     * @return UserCourse|null
     */
    public function destroy(UserCourse $userCourse): ?UserCourse
    {
        DB::beginTransaction();

        try {
            $userCourse->delete();

            DB::commit();

            return $userCourse;
        }catch (Exception){

            DB::rollBack();

            return null;
        }
    }
}
