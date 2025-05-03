<?php

use Illuminate\Support\Collection;

if (! function_exists('getFilterCollectionIds')) {
    function getFilterCollectionIds($collection = null, string $pluck = 'id'): Collection
    {
        return collect($collection)->pluck($pluck)->filter();
    }
}

if (! function_exists('getElementsNotInFirstCollection')) {
    function getElementsNotInFirstCollection(Collection $first, Collection $target): Collection
    {
        return $target->diff($first);
    }
}
