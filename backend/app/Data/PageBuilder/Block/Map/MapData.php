<?php

namespace App\Data\PageBuilder\Block\Map;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MapData extends Data
{
    public function __construct(
        public string $title,

        // prettier-ignore
        #[LiteralTypeScriptType('[number, number]')]
        public array $center,

        public int $zoom,

        /** @var MapItemData[] */
        public array $items,
    ) {}
}
