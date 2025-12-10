<?php

namespace App\Models\Concerns;

use App\Models\MetaTag;

trait HasMetaTags
{
    public function metaTag()
    {
        return $this->morphOne(MetaTag::class, 'metaable');
    }
}
