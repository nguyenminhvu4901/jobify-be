<?php

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;

if (! function_exists('formatPaginationData')) {
    function formatPaginationData($data): array
    {
        if ($data instanceof LengthAwarePaginator && ! empty($data->total())) {
            return [
                'current_page' => $data->currentPage(),
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'has_more_pages' => $data->hasMorePages(),
                'first_item' => $data->firstItem(),
                'last_item' => $data->lastItem(),
            ];
        }

        return [];
    }
}

if (! function_exists('formatCursorPaginationData')) {
    function formatCursorPaginationData($data): array
    {
        if ($data instanceof CursorPaginator && ! empty($data->hasMorePages())) {
            $items = $data->items();

            return [
                'per_page' => $data->perPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'has_more_pages' => $data->hasMorePages(),
                'total' => $data->count(),
                'next_cursor' => optional($data->nextCursor())->encode(),
                'prev_cursor' => optional($data->previousCursor())->encode(),
                //                "first_item" => !empty($items) ? $items[0] : null,
                //                "last_item" => !empty($items) ? end($items) : null,
            ];
        }

        return [];
    }
}
