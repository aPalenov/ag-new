<?php

namespace App\Data\PageBuilder\Block\SpecsShort;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsShortSecondData extends Data
{
    public function __construct(
        public string $label,

        public string $value,
    ) {}
}
