<?php

namespace App\Repositories\UserActivityResource;

use App\Entities\UserActivityResource\UserActivityResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserActivityResourceRepositoryEloquent extends BaseRepository implements UserActivityResourceRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivityResource::class;
    }

    /**
     * @param array $userActivityResourceId
     * @return mixed
     */
    public function getListUserActivityResourceByIds(array $userActivityResourceId): mixed
    {
        return $this->model->whereIn('id', $userActivityResourceId)->get();
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function store(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $userActivityResource = $this->model->create($attributes);

            if(!$userActivityResource){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userActivityResource
            ];
        }catch (Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param array $attributes
     * @param int|string $userActivityResourceId
     * @return mixed
     */
    public function updateUserActivityResource(array $attributes, int|string $userActivityResourceId): mixed
    {
        DB::beginTransaction();

        try {
            $userActivityResource = $this->model->find($userActivityResourceId);

            if(!$userActivityResource){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userActivityResource->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'userActivity' => $userActivityResource->refresh()
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
     * @param UserActivityResource $userActivityResource
     * @return array
     */
    public function destroy(UserActivityResource $userActivityResource): array
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userActivityResource->delete();

            DB::commit();

            return [
                'success' => (bool) $isDeleted
            ];
        }catch (Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}
