<?php

namespace App\Data\PageBuilder\Block\BlockCarouselMain;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BlockCarouselMainSlideData extends Data
{
    public function __construct(
        public string $imageName,

        public string $text,

        public string $subtext,

        public string $author,
    ) {}
}
