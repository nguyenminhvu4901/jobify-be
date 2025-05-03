<?php

namespace App\Repositories;

use App\Enums\Paginate\PaginateEnum;
use App\Models\User;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository as Repository;

abstract class BaseRepository extends Repository
{
    /**
     * @param  null  $slug
     */
    public function findBySlug(
        $slug = null,
        array|string $columns = ['*']
    ): ?User {
        return $this->model->where('slug', $slug)->select($columns)->firstOrFail();
    }

    public function findByUserId(
        $userId,
        array|string $columns = ['*']
    ): mixed {
        return $this->model->where('id', $userId)->select($columns)->first();
    }

    public function getByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed {
        $query = $this->queryByUserSlug($userSlug, $relationship, $relationshipCallbacksToFilter);

        return $query->select($columns)->get();
    }

    /**
     * @param  null  $limit
     */
    public function paginateByRelationshipUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        $limit = null
    ): LengthAwarePaginator {
        $query = $this->queryByUserSlug($userSlug, $relationship, $relationshipCallbacksToFilter);

        return $query->paginate($limit ?? PaginateEnum::PAGINATE_DEFAULT->value);
    }

    private function queryByUserSlug(
        $userSlug,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
    ): mixed {
        $query = $this->model
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query;
    }

    public function findByRelationshipUserSlugAndColumnDetailId(
        $userSlug,
        $idColumn,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed {
        $query = $this->model->where('id', $idColumn)
            ->whereHas('user', function ($query) use ($userSlug) {
                return $query->where('slug', $userSlug);
            });

        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query->select($columns)->firstOrFail();
    }

    public function getWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): Collection {
        $query = $this->model->newQuery();

        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query->select($columns)->get();
    }

    /**
     * @param  null  $limit
     */
    public function paginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        $limit = null,
        array|string $columns = ['*']
    ): LengthAwarePaginator {
        $query = $this->model->newQuery();

        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query->paginate(
            perPage: $limit ?? PaginateEnum::PAGINATE_DEFAULT->value,
            columns: $columns
        );
    }

    /**
     * @param  null  $limit
     * @param  string[]  $columns
     */
    public function cursorPaginateWithRelationship(
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $orderColumn = 'id',
        string $orderCondition = 'asc',
        $limit = null,
        array|string $columns = ['*']
    ): CursorPaginator {
        $query = $this->model->newQuery();

        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query->orderBy($orderColumn, $orderCondition)
            ->cursorPaginate(
                perPage: $limit ?? PaginateEnum::PAGINATE_DEFAULT->value,
                columns: $columns
            );
    }

    private function loadRelationship($relationship): array
    {
        return is_array($relationship) ? $relationship : [$relationship];
    }

    /**
     * @param  array  $relationshipCallbacksToFilter  = []
     */
    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacksToFilter = [],
        array|string $columns = ['*']
    ): mixed {

        $query = $this->model->newQuery();
        if (! empty($relationship)) {
            $relationship = $this->loadRelationship($relationship);

            if (! empty($relationshipCallbacksToFilter)) {
                $query->with(array_merge($relationship, $relationshipCallbacksToFilter));
            } else {
                $query->with($relationship);
            }
        }

        return $query->select($columns)->find($id);
    }

    /**
     * @return array|false[]
     */
    public function storeDataWithTransaction(
        array $attributes = [],
        array|string $relationships = []
    ): array {
        DB::beginTransaction();

        try {
            $data = $this->model->with($relationships)->create($attributes);

            if (! $data) {
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

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());

            return [
                'success' => false,
                'message' => __('messages.response.create_resource_failed'),
                'error' => $e,
            ];
        }
    }

    public function updateDataWithTransaction(array $attributes, int|string $id): array
    {
        DB::beginTransaction();

        try {
            $data = $this->model->find($id);

            if (! $data) {
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $isUpdated = $data->update($attributes);

            if (! $isUpdated) {
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
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.update_resource_failed'),
                'error' => $e,
            ];
        }
    }

    public function destroyDataWithTransaction(int|string $id): array
    {
        DB::beginTransaction();

        try {
            $data = $this->model->find($id);

            if (! $data) {
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $isDeleted = $data->delete();

            if (! $isDeleted) {
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
                'data' => $data,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.delete_resource_failed'),
                'error' => $e,
            ];
        }
    }

    public function getByIds(
        array $ids,
        array|string $columns = ['*']
    ): mixed {
        return $this->model->whereIn('id', $ids)->select($columns)->get();
    }

    public function getByValueColumn(
        string $columnName,
        int|string $columnValue,
        string $operation = '=',
        array|string $relationship = [],
        array|string $columns = ['*']
    ): Collection {
        return $this->builderValueColumn(
            $columnName,
            $operation,
            $columnValue,
            $relationship,
            $columns
        )->latest('id')->get();
    }

    public function findByValueColumn(
        string $columnName,
        int|string $columnValue,
        string $operation = '=',
        array|string $relationship = [],
        array|string $columns = ['*']
    ): mixed {
        return $this->builderValueColumn(
            $columnName,
            $operation,
            $columnValue,
            $relationship,
            $columns
        )->first();
    }

    private function builderValueColumn(
        string $columnName,
        int|string $columnValue,
        string $operation = '=',
        array|string $relationship = [],
        array|string $columns = ['*']
    ): Builder {
        return $this->model->with($relationship)->where($columnName, $operation, $columnValue)->select($columns);
    }

    public function insertTransaction(array $attributes): array
    {
        DB::beginTransaction();

        try {
            $inserted = $this->model->insert($attributes);

            if (! $inserted) {
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
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.create_resource_failed'),
                'error' => $e->getMessage(),
            ];
        }
    }

    public function massDeleteTransaction(string $col, array $values): array
    {
        DB::beginTransaction();

        try {
            $deletedRows = $this->model->whereIn($col, $values)->delete();

            if ($deletedRows === 0) {
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
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('messages.response.delete_resource_failed'),
                'error' => $e->getMessage(),
            ];
        }
    }
}
