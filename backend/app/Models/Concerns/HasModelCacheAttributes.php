<?php

namespace App\Models\Concerns;

trait HasModelCacheAttributes
{
    use HasCacheAttributes;

    /**
     * Reload the current model instance with fresh attributes from the database.
     *
     * @return $this
     */
    public function refresh()
    {
        $this->resetCachedAttributes();

        return parent::refresh();
    }
}
