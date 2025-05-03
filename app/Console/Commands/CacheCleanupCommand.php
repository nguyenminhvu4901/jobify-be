<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CacheCleanupCommand extends Command
{
    protected $signature = 'cache:clear-redis';

    protected $description = 'Delete all Redis cache if keys exceed 1,000,000.';

    public function handle(): void
    {
        $redis = Redis::connection('cache');
        $totalKeys = $redis->dbsize();

        if ($totalKeys >= 1000000) {

            Cache::flush();
            Log::info("Deleted all cache because Redis had $totalKeys keys.");
        } else {
            Log::warning('Redis cache is below the limit, no need to delete.');
        }
    }
}
