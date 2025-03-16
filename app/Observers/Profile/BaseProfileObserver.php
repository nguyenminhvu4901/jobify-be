<?php

namespace App\Observers\Profile;
use Illuminate\Support\Facades\Cache;

abstract class BaseProfileObserver
{
    /**
     * @var array
     */
    protected array $cacheTag = [];

    /**
     * @return void
     */
    public function created(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    public function updated(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    public function saved(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    public function deleted(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    public function restored(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    public function forceDeleted(): void
    {
        $this->clearCache();
    }

    /**
     * @return void
     */
    private function clearCache(): void
    {
        if (!empty($this->cacheTag)) {
            foreach ($this->cacheTag as $cache){
                Cache::tags([$cache])->flush();
            }
        }
    }
}
