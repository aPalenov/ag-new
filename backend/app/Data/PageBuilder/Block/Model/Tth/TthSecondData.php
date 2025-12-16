<?php

namespace App\Data\PageBuilder\Block\Model\Tth;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TthSecondData extends Data
{
    public function __construct(
        public string $label,

        public string $value,
    ) {}
}
