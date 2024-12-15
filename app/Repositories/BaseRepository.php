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
}
