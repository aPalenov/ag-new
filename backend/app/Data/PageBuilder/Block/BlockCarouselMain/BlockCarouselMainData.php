<?php

namespace App\Data\PageBuilder\Block\BlockCarouselMain;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BlockCarouselMainData extends Data
{
    public function __construct(
        /** @var BlockCarouselMainSlideData[] */
        public array $slides,
    ) {}
}
