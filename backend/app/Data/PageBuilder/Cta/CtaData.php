<?php

namespace App\Data\PageBuilder\Cta;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CtaData extends Data
{
    public function __construct(
        public string $label,

        public string $url,
    ) {}
}
