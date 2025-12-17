<?php

namespace App\Data\PageBuilder\Block\SpecsShort;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsShortData extends Data
{
    public function __construct(
        public string $title,

        /** @var SpecsShortFirstData[] */
        public array $first_specs,

        /** @var SpecsShortSecondData[] */
        public array $second_specs,
    ) {}
}
