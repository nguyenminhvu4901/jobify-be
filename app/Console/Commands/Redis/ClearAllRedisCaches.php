<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ClearAllRedisCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:clear-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all custom Redis caches (cache, hard_cache, queue)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (['cache', 'hard_cache', 'queue'] as $connection) {
            Redis::connection($connection)->flushdb();
            $this->components->info("Flushed Redis connection: {$connection}");
        }

        return CommandAlias::SUCCESS;
    }
}
