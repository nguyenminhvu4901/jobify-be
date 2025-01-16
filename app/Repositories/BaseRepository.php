<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
    public function findByRelationshipUserSlug($userSlug, array|string $relationship = []): mixed
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
     * @param array $relationshipCallbacks = []
     * @return mixed
     */
    public function findWithRelationships(
        int|string $id,
        array|string $relationship = [],
        array $relationshipCallbacks = []
    ): mixed
    {
        $query = $this->model->newQuery();

        if(!empty($relationship)){
            $relationship = is_array($relationship) ? $relationship : [$relationship];

            if (!empty($relationshipCallbacks)) {
                foreach ($relationship as $rel) {
                    if (!empty($relationshipCallbacks[$rel])) {
                        $query->with([$rel => $relationshipCallbacks[$rel]]);
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
}
