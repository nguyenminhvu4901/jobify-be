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
     * @param $slug
     * @param $columnKey
     * @param $columnValue
     * @return mixed
     */
    public function findByUserSlugAndColumnDetail($slug, $columnKey, $columnValue): mixed
    {
        return $this->model->where($columnKey, $columnValue)
            ->whereHas('user', function ($query) use($slug) {
                return $query->where('slug', $slug);
            })->get();
    }
}
