<?php

namespace App\Traits\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
    protected function buildPaginationResponse($data): array
    {
        if ($data instanceof LengthAwarePaginator) {

            return [
                "current_page" => $data->currentPage(),
                "total" => $data->total(),
                "per_page" => $data->perPage(),
                "last_page" => $data->lastPage(),
                "next_page_url" => $data->nextPageUrl(),
                "prev_page_url" => $data->previousPageUrl(),
                "has_more_pages" => $data->hasMorePages(),
                "count" => $data->count(),
                "first_item" => $data->firstItem(),
                "last_item" => $data->lastItem()
            ];
        }

        return [];
    }
}
