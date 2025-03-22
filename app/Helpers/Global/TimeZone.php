<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

if (!function_exists('formatDateTime')) {
    /**
     *
     * @param string|null $datetime
     * @return string
     */
    function formatDateTime(?string $datetime): string
    {
        try {
            return Carbon::parse($datetime)->format('H:i:s d-m-Y');
        } catch (Exception $e) {
            return Carbon::now()->format('H:i:s d-m-Y');
        }
    }
}

if (!function_exists('formatDate')) {
    /**
     *
     * @param string|null $date
     * @return string
     */
    function formatDate(?string $date): string
    {
        try {
            return Carbon::parse($date)->format('d-m-Y');
        } catch (Exception $e) {
            return Carbon::now()->format('d-m-Y');
        }
    }
}

if (!function_exists('addTimestamps')) {
    /**
     * Add created_at and updated_at timestamps to an array or collection.
     *
     * @param array|Collection $data
     * @return array
     */
    function addTimestamps(array|Collection $data): array
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        return array_map(fn ($item) => array_merge($item, [
            'created_at' => $now,
            'updated_at' => $now,
        ]), $data);
    }
}

