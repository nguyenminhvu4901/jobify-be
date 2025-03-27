<?php

namespace App\Repositories;

use App\Enums\QueryConstant;
use App\Models\User;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository as Repository;

abstract class BaseRepository extends Repository
{
    /**
     * @param null $slug
     * @param array|string $columns
     * @return null|User
     */
    public function findBySlug(
        $slug = null,
        array|string $columns = ['*']
    ): null|User
    {
        return $this->model->where('slug', $slug)->select($columns)->firstOrFail();
    }

    /**
     * @param $userId
     * @param array|string $columns
     * @return mixed
     */
    public function findByUserId(
        $userId,
        array|string $columns = ['*']
    ): mixed
    {
        return $this->model->where('id', $userId)->select($columns)->first();
    }

    /**
     * @param $userSlug
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param array|string $columns
     * @return mixed
     */
    public function getByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed
    {
        $query = $this->queryByUserSlug($userSlug, $relationship, $relationshipCallbacksToFilter);

        return $query->select($columns)->get();
    }

    /**
     * @param $userSlug
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param null $limit
     * @return LengthAwarePaginator
     */
    public function paginateByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        $limit = null
    ): LengthAwarePaginator
    {
        $query = $this->queryByUserSlug($userSlug, $relationship, $relationshipCallbacksToFilter);

        return $query->paginate($limit ?? QueryConstant::PAGINATE_DEFAULT->value);
    }

    /**
     * @param $userSlug
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @return mixed
     */
    private function queryByUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed
    {
        $query = $this->model
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query;
    }


    /**
     * @param $userSlug
     * @param $idColumn
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param array|string $columns
     * @return mixed
     */
    public function findByRelationshipUserSlugAndColumnDetailId(
        $userSlug,
        $idColumn,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed
    {
        $query = $this->model->where('id', $idColumn)
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query->select($columns)->firstOrFail();
    }

    /**
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param array|string $columns
     * @return Collection
     */
    public function getWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): Collection
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query->select($columns)->get();
    }


    /**
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param null $limit
     * @param array|string $columns
     * @return LengthAwarePaginator
     */
    public function paginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        $limit = null,
        array|string $columns = ['*']
    ): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query->paginate(
            perPage: $limit ?? QueryConstant::PAGINATE_DEFAULT->value,
            columns: $columns
        );
    }

    /**
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter
     * @param array|string $orderColumn
     * @param string $orderCondition
     * @param null $limit
     * @param string[] $columns
     * @return CursorPaginator
     */
    public function cursorPaginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $orderColumn = 'id',
        string $orderCondition = 'asc',
        $limit = null,
        array|string $columns = ['*']
    ): CursorPaginator
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query->orderBy($orderColumn, $orderCondition)
            ->cursorPaginate(
            perPage: $limit ?? QueryConstant::PAGINATE_DEFAULT->value,
            columns: $columns
        );
    }

    /**
     * @param $relationship
     * @return array
     */
    private function loadRelationship($relationship): array
    {
        return is_array($relationship) ? $relationship : [$relationship];
    }

    /**
     * @param int|string $id
     * @param array|string $relationship
     * @param array $relationshipCallbacksToFilter = []
     * @param array|string $columns
     * @return mixed
     */
    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed
    {

        $query = $this->model->newQuery();
        if(!empty($relationship)){
            $relationship = $this->loadRelationship($relationship);

            if(!empty($relationshipCallbacksToFilter)){
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            }else{
                $query->with($relationship);
            }
        }

        return $query->select($columns)->find($id);
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

    /**
     * @param int|string $id
     * @return array
     */
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

    /**
     * @param array $ids
     * @param array|string $columns
     * @return mixed
     */
    public function getByIds(
        array $ids,    array|string $columns = ['*']
    ): mixed
    {
        return $this->model->whereIn('id', $ids)->select($columns)->get();
    }
}
