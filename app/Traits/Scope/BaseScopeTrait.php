<?php

namespace App\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait BaseScopeTrait
{
    /**
     * @param Builder $query
     * @param string $keyword
     * @param array $columns
     * @param string $mode
     * @return Builder
     */
    public function scopeSearchFullText(
        Builder $query,
        string $keyword,
        array $columns,
        string $mode = 'NATURAL LANGUAGE MODE'
    ): Builder
    {
        $columnsList = implode(', ', $columns);

        return $query->whereRaw("MATCH({$columnsList} AGAINST(? IN $mode)", [$keyword]);
    }
}
