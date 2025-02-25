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
     * @return array
     */
    public function store(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $userCourseResource = $this->model->create($attributes);

            if(!$userCourseResource){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userCourseResource
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
     * @param int|string $userCourseResourceId
     * @return array
     */
    public function updateUserCourseResource(array $attributes, int|string $userCourseResourceId): array
    {
        DB::beginTransaction();

        try {
            $userCourseResource = $this->model->find($userCourseResourceId);

            if(!$userCourseResource){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userCourseResource->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'userCourseResource' => $userCourseResource->refresh()
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
     * @param UserCourseResource $userCourseResource
     * @return array
     */
    public function destroy(UserCourseResource $userCourseResource): array
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userCourseResource->delete();

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

    /**
     * @param array $userCourseResourceId
     * @return mixed
     */
    public function getListUserCourseResourceByIds(array $userCourseResourceId): mixed
    {
        return $this->model->whereIn('id', $userCourseResourceId)->get();
    }
}
