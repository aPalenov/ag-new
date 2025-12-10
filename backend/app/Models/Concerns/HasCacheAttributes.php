<?php

namespace App\Models\Concerns;

use Closure;

trait HasCacheAttributes
{
    private $cachedAttributes = [];

    public function cacheAttribute(string $key, $value = null)
    {
        if (!array_key_exists($key, $this->cachedAttributes)) {
            $this->setCachedAttribute($key, $value);
        }

        return $this->cachedAttributes[$key];
    }

    public function setCachedAttribute(string $key, $value)
    {
        return $this->cachedAttributes[$key] = $value instanceof Closure ? $value() : $value;
    }

    public function resetCachedAttributes()
    {
        $this->cachedAttributes = [];
    }
}
