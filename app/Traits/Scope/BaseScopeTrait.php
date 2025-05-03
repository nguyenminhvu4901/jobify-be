<?php

namespace App\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait BaseScopeTrait
{
    public function scopeSearchFullText(
        Builder $query,
        string $keyword,
        array $columns,
        string $mode = 'NATURAL LANGUAGE MODE'
    ): Builder {
        $columnsList = implode(', ', $columns);

        return $query->whereRaw("MATCH({$columnsList} AGAINST(? IN $mode)", [$keyword]);
    }

    public function scopeWhereById(Builder $query, $id): Builder
    {
        if (! empty($id)) {
            return $query->where('id', $id);
        }

        return $query;
    }

    public function scopeWithRelationships(Builder $query, string|array|null $relationships): Builder
    {
        if (empty($relationships)) {
            return $query;
        }

        if (is_string($relationships)) {
            $relationships = array_map('trim', explode(',', $relationships));
        }

        return $query->with($relationships);
    }
}
