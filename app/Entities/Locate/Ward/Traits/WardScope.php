<?php

namespace App\Entities\Locate\Ward\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WardScope
{
    /**
     * @param Builder $query
     * @param $districtId
     * @return Builder
     */
    public function scopeWhereDistrict(Builder $query, $districtId): Builder
    {
        if(!empty($districtId)){
            return $query->where('district_id', $districtId);
        }

        return $query;
    }
}
