<?php

namespace App\Models\Traits;

use Generator;
use Illuminate\Support\Facades\Cache;

/**
 * gives cache layer to models
 */
trait CachesItself
{
    /**
     * @return Generator<callable> each yield is a callable that takes model as only argument and that gives a cache key after table name prefix
     */
    abstract protected function getSelfCacheKeys(): Generator;

    protected function cacheSelf(): void
    {
        $prefix = $this->getTable() . ':';

        foreach ($this->getSelfCacheKeys() as $key) {
            Cache::set($prefix . $key($this), $this, 86400);
        }
    }

    protected function uncacheSelf(): void
    {
        $prefix = $this->getTable() . ':';

        foreach ($this->getSelfCacheKeys() as $key) {
            Cache::forget($prefix . $key($this));
        }
    }
}
