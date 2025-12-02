<?php

namespace App\Data\PageBuilder\Block\BlockCarouselMain;

use Spatie\LaravelData\Data;

class BlockCarouselMainDatabaseData extends Data
{
    public function __construct(
        /** @var BlockCarouselMainSlideDatabaseData[] */
        public array $slides,
    ) {}
}
