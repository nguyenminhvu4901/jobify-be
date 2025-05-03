<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

if (! function_exists('formatDateTime')) {
    function formatDateTime(?string $datetime): ?string
    {
        if (empty($datetime)) {
            return null;
        }

        if (! Carbon::hasFormatWithModifiers($datetime, 'Y-m-d H:i:s')) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('H:i:s d-m-Y');
    }
}

if (! function_exists('formatDate')) {
    function formatDate(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('d-m-Y');
        } catch (\Exception $e) {
            return null;
        }
    }
}

if (! function_exists('addTimestamps')) {
    /**
     * Add created_at and updated_at timestamps to an array or collection.
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
