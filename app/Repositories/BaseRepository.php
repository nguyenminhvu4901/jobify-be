<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository as Repository;

abstract class BaseRepository extends Repository
{
    /**
     * @param $slug
     * @return null|User
     */
    public function findBySlug($slug = null): null|User
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findByUserId($userId): mixed
    {
        return $this->model->where('id', $userId)->first();
    }

    /**
     * @param $userSlug
     * @param array|string $relationship
     * @return mixed
     */
    public function getByRelationshipUserSlug($userSlug, array|string $relationship = []): mixed
    {
        $query = $this->model
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if (!empty($relationship)) {
            $relationship = is_array($relationship) ? $relationship : [$relationship];
            $query->with($relationship);
        }

        return $query->get();
    }


    /**
     * @param $userSlug
     * @param $idColumn
     * @param array|string $relationship
     * @return mixed
     */
    public function findByRelationshipUserSlugAndColumnDetailId($userSlug, $idColumn, array|string $relationship = []): mixed
    {
        $query = $this->model->where('id', $idColumn)
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if (!empty($relationship)) {
            $relationship = is_array($relationship) ? $relationship : [$relationship];
            $query->with($relationship);
        }

        return $query->firstOrFail();
    }

    /**
     * @param array|string $relationship
     * @return Collection
     */
    public function getWithRelationship(array|string $relationship = []): Collection
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = is_array($relationship) ? $relationship : [$relationship];
            $query->with($relationship);
        }

        return $query->get();
    }

    /**
     * @param int|string $id
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter = []
     * @return mixed
     */
    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = []
    ): mixed
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = is_array($relationship) ? $relationship : [$relationship];

            if (!empty($relationshipCallbacksToFilter)) {
                foreach ($relationship as $rel) {
                    if (!empty($relationshipCallbacksToFilter[$rel])) {
                        $query->with([$rel => $relationshipCallbacksToFilter[$rel]]);
                    } else {
                        $query->with($rel);
                    }
                }
            } else {
                $query->with($relationship);
            }
        }

        return $query->find($id);
    }

    /**
     * @param array $attributes
     * @return array|false[]
     */
    public function storeDataWithTransaction(array $attributes = []): array
    {
        DB::beginTransaction();

        try {
            $data = $this->model->create($attributes);

            if(!$data){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.create_resource_failed'),
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'message' => __('messages.response.create_resource_success'),
                'data' => $data->refresh(),
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.create_resource_failed'),
                'error' => $e
            ];
        }
    }

    /**
     * @param array $attributes
     * @param int|string $id
     * @return array
     */
    public function updateDataWithTransaction(array $attributes, int|string $id): array
    {
        DB::beginTransaction();

        try {
            $data = $this->model->find($id);

            if(!$data){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $isUpdated = $data->update($attributes);

            if(!$isUpdated){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.update_resource_failed'),
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'message' => __('messages.response.update_resource_success'),
                'data' => $data->refresh(),
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.update_resource_failed'),
                'error' => $e
            ];
        }
    }

    public function destroyDataWithTransaction(int|string $id): array
    {
        DB::beginTransaction();

        try {
            $data = $this->model->find($id);

            if(!$data){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $isDeleted = $data->delete();

            if(!$isDeleted){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.delete_resource_failed'),
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'message' => __('messages.response.delete_resource_success'),
                'data' => $data
            ];
        }catch (\Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.delete_resource_failed'),
                'error' => $e
            ];
        }
    }

    public function getByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }
}
