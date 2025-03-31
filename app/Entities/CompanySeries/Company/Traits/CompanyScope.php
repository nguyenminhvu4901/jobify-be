<?php

namespace App\Entities\CompanySeries\Company\Traits;

use Illuminate\Database\Query\Builder;

trait CompanyScope
{
    /**
     * @param Builder $query
     * @param $userId
     * @return Builder
     */
    public function scopeWhereUserId(Builder $query, $userId): Builder
    {
        if(!empty($userId)){
            return $query->where('user_id', $userId);
        }

        return $query;
    }
}
