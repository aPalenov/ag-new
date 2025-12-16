<?php

namespace App\Data\PageBuilder\Block\Model\Tth;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TthFirstData extends Data
{
    public function __construct(
        public string $icon,

        public string $label,

        public string $value,
    ) {}
}
