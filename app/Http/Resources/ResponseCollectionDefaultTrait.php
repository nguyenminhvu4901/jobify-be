<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseCollectionDefaultTrait
{
    public function responseDataDefault(): array
    {
        return $this->resource instanceof LengthAwarePaginator
            ? $this->toPaginate() : $this->toCollection();
    }

    public function toArray(Request $request): array
    {
        return $this->responseDataDefault();
    }

    public function toCollection(): array
    {
        return [
            'data' => $this->collection,
        ];
    }

    public function toPaginate(): array
    {
        return [
            'data' => $this->collection,
            'current_page' => $this->currentPage(),
            'total' => $this->total(),
            'per_page' => $this->perPage(),
            'last_page' => $this->lastPage(),
            'next_page_url' => $this->nextPageUrl(),
            'prev_page_url' => $this->previousPageUrl(),
            'has_more_pages' => $this->hasMorePages(),
            'count' => $this->count(),
            'first_item' => $this->firstItem(),
            'last_item' => $this->lastItem(),
        ];
    }
}
