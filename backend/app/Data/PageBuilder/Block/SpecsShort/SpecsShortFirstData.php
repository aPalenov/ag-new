<?php

namespace App\Data\PageBuilder\Block\SpecsShort;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsShortFirstData extends Data
{
    public function __construct(
        public string $icon,

        public string $label,

        public string $value,
    ) {}
}
