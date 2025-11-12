<?php

namespace App\Data\PageBuilder\Block\BlockCarouselMain;

use Spatie\LaravelData\Data;

class BlockCarouselMainSlideDatabaseData extends Data
{
    public function __construct(
        public string $imageName,

        public string $text,

        public string $subtext,

        public string $author,
    ) {}
}
