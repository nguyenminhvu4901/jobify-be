<?php

namespace App\Repositories\UserCourseResource;

use App\Entities\UserCourseResource\UserCourseResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserCourseResourceRepositoryEloquent extends BaseRepository implements UserCourseResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserCourseResource::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userCourseResource = $this->model->create($attributes);

            DB::commit();

            return $userCourseResource->refresh();
        }catch (Exception){

            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userCourseResourceId
     * @return mixed
     */
    public function updateUserCourseResource(array $attributes, int|string $userCourseResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userCourseResource = $this->model->find($userCourseResourceId);

            $userCourseResource->update($attributes);

            DB::commit();

            return $userCourseResource->refresh();
        }catch (Exception){

            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserCourseResource $userCourseResource
     * @return UserCourseResource|null
     */
    public function destroy(UserCourseResource $userCourseResource): ?UserCourseResource
    {
        DB::beginTransaction();

        try {
            $userCourseResource->delete();

            DB::commit();

            return $userCourseResource->refresh();
        }catch (Exception){

            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $userCourseResourceId
     * @return mixed
     */
    public function getListUserCourseResourceByIds(array $userCourseResourceId): mixed
    {
        return $this->model->whereIn('id', $userCourseResourceId)->get();
    }
}
