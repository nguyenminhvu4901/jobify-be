<?php

namespace App\Entities\JobSeries\Position\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PositionScope
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthOrdered(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder();
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthRootOrdered(Builder $query): mixed
    {
        return $query->withDepth()->whereIsRoot()->defaultOrder();
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthOrderedToTree(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder()->get()->toTree();
    }
}
