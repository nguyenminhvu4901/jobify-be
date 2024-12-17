<?php

if (!function_exists('extractEmailPrefix')) {
    function extractEmailPrefix(string $email): string
    {
        return strstr($email, '@', true);
    }
}
