<?php

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

if (!function_exists('redisCacheDB')) {
    /**
     * @return Repository
     */
    function redisCacheDB(): Repository
    {
        return Cache::store('cache');
    }
}

if (!function_exists('redisHardCacheDB')) {
    /**
     * @return Repository
     */
    function redisHardCacheDB(): Repository
    {
        return Cache::store('hard_cache');
    }
}

if (!function_exists('redisQueueDB')) {
    /**
     * @return Repository
     */
    function redisQueueDB(): Repository
    {
        return Cache::store('queue');
    }
}
