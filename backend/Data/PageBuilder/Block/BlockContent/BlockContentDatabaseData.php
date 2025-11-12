<?php

namespace App\Data\PageBuilder\Block\BlockContent;

use Spatie\LaravelData\Data;

class BlockContentDatabaseData extends Data
{
    public function __construct(
        // prettier-ignore
        public string $text,
    ) {}
}
