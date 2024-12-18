<?php

if (!function_exists('extractEmailPrefix')) {
    /**
     * @param string $email
     * @return string
     */
    function extractEmailPrefix(string $email): string
    {
        return strstr($email, '@', true);
    }
}

if (!function_exists('getStatus')) {
    /**
     * @param int $status
     * @return bool
     */
    function getStatus(int $status): bool
    {
        return $status === 1;
    }
}

if (!function_exists('convertVideoSizToMB')) {
    /**
     * @param $requestVideo
     * @return float|int
     */
    function convertVideoSizToMB($requestVideo): float|int
    {
        return ($requestVideo->getSize() / (1024 * 1024));
    }
}
