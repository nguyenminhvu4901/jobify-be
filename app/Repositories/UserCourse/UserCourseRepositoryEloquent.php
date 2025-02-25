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
     * @return array
     */
    public function store(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $userCourse = $this->model->create($attributes);

            if(!$userCourse){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userCourse
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userCourseId
     * @return array
     */
    public function updateUserCourse(array $attributes, int|string $userCourseId): array
    {
        DB::beginTransaction();

        try {
            $userCourse = $this->model->find($userCourseId);

            if(!$userCourse){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userCourse->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'data' => $userCourse->refresh()
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }


    /**
     * @param UserCourse $userCourse
     * @return array|bool[]
     */
    public function destroy(UserCourse $userCourse): array
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userCourse->delete();

            DB::commit();

            return [
                'success' => (bool) $isDeleted
            ];
        }catch (Exception $e){

            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}
