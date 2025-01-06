<?php

namespace App\Repositories;

use App\Models\User;
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
}
