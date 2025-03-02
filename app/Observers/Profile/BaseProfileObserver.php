<?php

namespace App\Observers\Profile;
use Illuminate\Support\Facades\Cache;

abstract class BaseProfileObserver
{
    protected string $cacheTag = '';

    public function created(): void
    {
        $this->clearCache();
    }

    public function updated(): void
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
        if ($this->cacheTag) {
            Cache::tags([$this->cacheTag])->flush();
        }
    }
}
