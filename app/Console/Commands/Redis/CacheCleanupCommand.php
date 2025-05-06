<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CacheCleanupCommand extends Command
{
    protected $signature = 'cache:clear-redis';
    protected $description = 'Delete all Redis cache if keys exceed 100.000';

    /**
     * @return void
     */
    public function handle(): void
    {
        $redis = Redis::connection('cache');

        $totalKeys = $redis->dbsize();

        if ($totalKeys >= 100000) {

            Redis::connection('cache')->flushdb();
            Log::info("Deleted all cache because Redis had $totalKeys keys.");
            $this->components->info("Flushed Redis connection: cache");
        } else {
            Log::warning("Redis cache is below the limit, no need to delete.");
            $this->components->warn("Flushed Error Redis connection: cache");
        }
    }
}
