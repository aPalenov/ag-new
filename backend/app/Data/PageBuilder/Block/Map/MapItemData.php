<?php

namespace App\Data\PageBuilder\Block\Map;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MapItemData extends Data
{
    public function __construct(
        public string $label,

        /** @var array{0:float,1:float} */
        public array $coordinates,
    ) {}
}
