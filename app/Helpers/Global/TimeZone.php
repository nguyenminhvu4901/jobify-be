<?php

use Carbon\Carbon;

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
