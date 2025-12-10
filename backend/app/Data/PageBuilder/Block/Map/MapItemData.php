<?php

namespace App\Data\PageBuilder\Block\Map;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MapItemData extends Data
{
    public function __construct(
        public string $label,

        // prettier-ignore
        #[LiteralTypeScriptType('[number, number]')]
        public array $coordinates,
    ) {}
}
