<?php

namespace App\Entities\Locate\District\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DistrictScope
{
    /**
     * @param Builder $query
     * @param $provinceId
     * @return Builder
     */
    public function scopeWhereProvinceId(Builder $query, $provinceId): Builder
    {
        if(!empty($districtId)){
            return $query->where('province_id', $provinceId);
        }

        return $query;
    }
}
