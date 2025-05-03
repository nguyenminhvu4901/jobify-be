<?php

namespace App\Entities\Locate\District\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DistrictScope
{
    public function scopeWhereProvinceId(Builder $query, $provinceId): Builder
    {
        if (! empty($districtId)) {
            return $query->where('province_id', $provinceId);
        }

        return $query;
    }
}
