<?php

namespace App\Data\PageBuilder\Color;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ColorData extends Data
{
    public function __construct(
        public int $id,

        public string $name,

        public string $hex,
    ) {}
}
