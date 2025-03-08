<?php

namespace App\Helpers\Global;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper
{
    /**
     * @param $data
     * @return array
     */
    public static function formatPaginationData($data): array
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
