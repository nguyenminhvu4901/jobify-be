<?php

use Illuminate\Support\Collection;

if (!function_exists('getFilterCollectionIds')) {
    /**
     * @param $collection
     * @param string $pluck
     * @return Collection
     */
    function getFilterCollectionIds($collection, string $pluck = 'id'): Collection
    {
        return collect($collection)->pluck($pluck)->filter();
    }
}

if (!function_exists('getElementsNotInFirstCollection')) {
    /**
     * @param Collection $first
     * @param Collection $target
     * @return Collection
     */
    function getElementsNotInFirstCollection(Collection $first, Collection $target): Collection
    {
        return $target->diff($first);
    }
}
