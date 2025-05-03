<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

abstract class BaseObserver
{
    protected array $cacheTag = [];

    public function created(): void
    {
        $this->clearCache();
    }

    public function updated(): void
    {
        $this->clearCache();
    }

    public function saved(): void
    {
        $this->clearCache();
    }

    public function deleted(): void
    {
        $this->clearCache();
    }

    public function restored(): void
    {
        $this->clearCache();
    }

    public function forceDeleted(): void
    {
        $this->clearCache();
    }

    private function clearCache(): void
    {
        if (! empty($this->cacheTag)) {
            foreach ($this->cacheTag as $cache) {
                Cache::tags([$cache])->flush();
            }
        }
    }
}
